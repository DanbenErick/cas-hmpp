<?php

require_once('../../src/config.php');
require_once(PATH_CONN_DB);

// if(isset($_POST['login'])) {
	$recaptcha = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LeugNkUAAAAAETcOoGUSnOkL77ATIgAULo-m6vB',
		'response' => $recaptcha
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = @file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);
    var_dump($captcha_success);
	if ($captcha_success->success) {
		if(!empty($_POST['Usuario']) && !empty($_POST['Password'])) {
            global $pdo;
            $sql = "SELECT * FROM users";
            $query = $pdo->prepare($sql);
            if($query->execute()) {
                foreach($query->fetchAll() as $valor) {
                    if($valor['user'] == $_POST['Usuario']) {
                        if(password_verify($_POST['Password'], $valor['password']) && $valor['state'] == 1 ){
                            session_start();
                            //Session de la ultima convocatoria
                            $sql_convocatory = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) from     announcements)";
                            $query_convocatory = $pdo->prepare($sql_convocatory);
                            if($query_convocatory->execute()) {
                                if($query_convocatory != null) {
                                    $result_query_convocatory = $query_convocatory->fetchAll();
                                    $_SESSION['id_denomination'] = $result_query_convocatory[0]['id'];
                                }
                            }
                            $_SESSION['id_user'] = $valor['id'];
                            $_SESSION['nameuser'] = $valor['name'];
                            $_SESSION['id_rol'] = $valor['id_rol'];
                            if($_SESSION['id_rol'] == 1) {
                                ir_sistema();
                            }else if($_SESSION['id_rol'] == 2) {
                                ir_supervisor();
                            }
                        }else {
                            // La contraseña no coincide
                            retornar_to_login("fail_credentials");
                        }
                    } else {
                        // El usuario no existe
                        retornar_to_login("fail");
                    }
                }
            }else {
                // La consulta fallo
                retornar_to_login("fail");
            }
        }else {
            //No rrellenaste todos los campos
            retornar_to_login("empty_camps");
        }
	} else {
		retornar_to_login("not_validate_captcha");
	}
// }else {
    // No ingreso por el boton submmit del formulario
//     retornar_to_login();
// }


// Redireccionamiento

function retornar_to_login($parametro = null) {
    // if($parametro != "") {
    //     header("Location: ../index.php?alert=$parametro");
    // }
    header("Location: ../index.php?alert=$parametro");
}

function ir_sistema() {
    header("Location: ../sistema");
}
function ir_supervisor() {
    header("Location: ../supervisor");
}
?>