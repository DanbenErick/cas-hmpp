<?php
//Only Test -------
include_once '../../../src/config.php';
include_once '../../src/config.php';
include_once "../src/config.php";
include_once 'src/config.php';
// session_start();
//----------------
if(@$_SESSION['id_user'] && @$_SESSION['id_rol'] == 1) {
    require(PATH_CONN_DB);
    $arrayJson = [];
    function get_convocatory() {
        global $pdo;
        $sql = "SELECT * FROM announcements WHERE state=1";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }
    }
    function get_document_by_id($id) {
        global $pdo;
        $sql = "SELECT * FROM documents WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }
    }
    function edit_document($id, $cod, $name) {
        global $pdo;
        $sql = "UPDATE documents SET cod_document= :cod, name_document= :name WHERE id= :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":cod", $cod);
        $update->bindParam(":name", $name);
        $update->bindParam(":id", $id);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Operacion Exitosa"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $update->errorInfo()
            ];
        }
    }
    function get_workplace_by_id($id) {
        global $pdo;
        $sql = "SELECT * FROM workplaces WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return $query->errorInfo();
        }
    }
    function edit_workplace($id, $cod, $position, $dependency) {
        global $pdo;
        $sql = "UPDATE workplaces SET cod_workplace= :cod, work_position= :position, dependency= :dependency WHERE id = :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":cod", $cod);
        $update->bindParam(":position", $position);
        $update->bindParam(":dependency", $dependency);
        $update->bindParam(":id", $id);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Operecion Exitosa"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $update->errorInfo()
            ];
        }
    }
    function edit_convocatory(
        $id_denomination,
        $denomination,
        $f_publication,
        $f_cv_start,
        $f_cv_end,
        $f_eval_cv_start,
        $f_eval_cv_end,
        $f_publication_accepted,
        $f_interview_start,
        $f_interview_end,
        $f_publication_end,
        $f_start_work
        ) {
        // $quantyEdition = "(SELECT quantity_edition from announcements where id = :id_denomination) + 1)";

        global $pdo;
        $sql = "UPDATE announcements SET
        denomination=:denomination
        ,f_publication=:f_publication
        ,f_cv_start=:f_cv_start
        ,f_cv_end=:f_cv_end
        ,f_eval_cv_start=:f_eval_cv_start
        ,f_eval_cv_end=:f_eval_cv_end
        ,f_publication_accepted=:f_publication_accepted
        ,f_interview_start=:f_interview_start
        ,f_interview_end=:f_interview_end
        ,f_publication_end=:f_publication_end
        ,f_start_work=:f_start_work
        ,f_last_edition=:f_last_edition
        WHERE :id_denomination";
        $hoy = date("Y-m-d");
        $update = $pdo->prepare($sql);
        $update->bindParam(":denomination",$denomination);
        $update->bindParam(":f_publication",$f_publication);
        $update->bindParam(":f_cv_start",$f_cv_start);
        $update->bindParam(":f_cv_end",$f_cv_end);
        $update->bindParam(":f_eval_cv_start",$f_eval_cv_start);
        $update->bindParam(":f_eval_cv_end",$f_eval_cv_end);
        $update->bindParam(":f_publication_accepted",$f_publication_accepted);
        $update->bindParam(":f_interview_start",$f_interview_start);
        $update->bindParam(":f_interview_end",$f_interview_end);
        $update->bindParam(":f_publication_end",$f_publication_end);
        $update->bindParam(":f_start_work",$f_start_work);
        $update->bindParam(":f_last_edition", $hoy);
        $update->bindParam(":id_denomination",$id_denomination);

        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Operacion Exitosa"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $update->errorInfo(),
            ];
        }
    }
    function last_convocatory($id_denomination = null) {
        global $pdo;
        $sql = "SELECT * FROM announcements WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id_denomination);

        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }
    }
    function verify_state_convocatoty(){
        $convocatory = last_convocatory($_SESSION['id_denomination']);
        if($convocatory != null) {
            if($convocatory[0]['state'] == 1) {
                return [
                    "code" => 0,
                    "data" => $convocatory[0]
                ];
            }else {
                return [
                    "code" => 1,
                    "msg" => "La convocatoria no esta vigente"
                ];
            }
        } else {
            return [
                "code" => 2,
                "msg" => "No se encontro un convocatoria con este id"
            ];
        }
    }
    function get_documents() {
        global $pdo;
        if(verify_state_convocatoty()['code'] == 0) {
            $sql_select = "SELECT * FROM documents WHERE id_denomination = :id_convocatoria";
            $consulta = $pdo->prepare($sql_select);
            $consulta->bindParam(":id_convocatoria", $_SESSION['id_denomination']);
            $consulta->execute();
            $arrayJson = null;
            while($datos = $consulta->fetchAll()) {
                $arrayJson = $datos;
            }
            return $arrayJson;
        }else {
            return null;
        }
    }
    function verify_code_documents($code) {
        $resultado = get_documents();
        if($resultado != null) {
            var_dump($resultado);
            foreach($resultado as $valor) {
                if($valor['cod_document'] === $code) {
                    return [
                        "code" => "1",
                        "msg" => "Existe un documento con este codigo"
                    ];
                }
            }
        }else {
            return [
                "code" => "2",
                "msg" => "No existe un documento con el codigo indicado"
            ];
        }
    }
    function get_workplaces() {
        global $pdo;
        if(verify_state_convocatoty()['code'] == 0) {
            $sql_select = "SELECT * FROM workplaces WHERE id_denomination = :id_plazas";
            $consulta = $pdo->prepare($sql_select);
            $consulta->bindParam(":id_plazas", $_SESSION['id_denomination']);
            $consulta->execute();
            $arrayJson = null;
            while($datos = $consulta->fetchAll()) {
                $arrayJson = $datos;
            }
            return $arrayJson;
        }else {
            return null;
        }
    }
    function verify_code_workplaces($code) {
        $resultado = get_workplaces();
        foreach($resultado as $valor) {
            if($valor['cod_workplace'] === $code) {
                return [
                    "code" => "1",
                    "msg" => "Existe una plaza con este codigo"
                ];
            }
        }
        return [
            "code" => "2",
            "msg" => "No existe una plaza con el codigo indicado"
        ];
    }
    function delete_workplace($id) {
        global $pdo;
        $sql =  "DELETE FROM workplaces WHERE id = :id";
        $delete = $pdo->prepare($sql);
        $delete->bindParam(":id", $id);
        if($delete->execute()) {
            return [
                "code"=> 1,
                "msg" => "Eliminacion se realizo correctamente"
            ];
        }else {
            return [
                "code"=> 2,
                "msg" => $delete->errorInfo()
            ];
        }
    }
    function delete_document($id) {
        global $pdo;
        $sql = "DELETE FROM documents WHERE id = :id";
        $delete = $pdo->prepare($sql);
        $delete->bindParam(":id", $id);
        $delete->execute();
        return [
            "code" => 1,
            "msg" => "Eliminacion correctamente realizada"
        ];
    }
    function delete_convocatory($id) {
        global $pdo;
        $sql = "UPDATE announcements SET state = 0, visible = 0 WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id);
        if($query->execute()) {
            return [
                "code" => 1,
                "msg" => "La eliminacion se llevo a cabo"
            ];
        }
        return [
            "code" => 2,
            "msg" => $query->errorInfo()[2]
        ];
    }
    function set_user($name, $user, $password, $id_rol, $state) {
        global $pdo;
        $sql = "INSERT INTO users (name, user, password, id_rol, state, time_created) VALUES (:name, :user, :password, :id_rol, :state, NOW())";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":name", $name);
        $insert->bindParam(":user", $user);
        $insert->bindParam(":password", $password);
        $insert->bindParam(":id_rol", $id_rol);
        $insert->bindParam(":state", $state);
        if($insert->execute()) {
            return [
                "code" => 1,
                "msg" => "La insercion fue exitosa"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $insert->errorInfo()
            ];
        }
    }
    function get_users() {
        global $pdo;
        $sql = "SELECT * FROM users";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }
    }

    function get_user_for_id($id) {
        global $pdo;
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }
    }
    function edit_user($id, $name, $user, $password, $id_rol, $state) {
        global $pdo;
        $sql = "UPDATE users SET name = :name, user = :user, password = :password, id_rol = :id_rol, state = :state WHERE id = :id";
        $edit = $pdo->prepare($sql);
        $edit->bindParam(":name", $name);
        $edit->bindParam(":user", $user);
        $edit->bindParam(":password", $password);
        $edit->bindParam(":id_rol", $id_rol);
        $edit->bindParam(":id", $id);
        $edit->bindParam(":state", $state);
        if($edit->execute()) {
            return [
                "code" => 1,
                "msg" => "Editado correctamente"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $edit->errorInfo()
            ];
        }
    }
    function delete_user($id) {
        global $pdo;
        $sql = "DELETE FROM users WHERE id = :id";
        $delete = $pdo->prepare($sql);
        $delete->bindParam(":id", $id);
        if($delete->execute()) {
            return [
                "code" => 1,
                "msg" => "Eliminado correctamente"
            ];
        }else {
            return [
                "code" => 2,
                "msg" => $delete->errorInfo()
            ];
        }
    }
}else if(@$_SESSION['id_user'] && @$_SESSION['id_rol'] == 2) {
    require_once('../../src/config.php');
    require(PATH_CONN_DB);

    function get_applicants_super(){
        global $pdo;
        $sql = "SELECT workplaces.work_position, applicants.* from workplaces INNER JOIN applicants ON workplaces.id = applicants.id_workplace AND applicants.id_denomination = (SELECT MAX(id) from announcements WHERE state = 1) AND applicants.accepted = 0 ORDER BY applicants.datetime";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }
        return null;
    }

    function accept_applicant($id, $calificacion = 0) {
        global $pdo;
        $sql = "UPDATE applicants SET accepted = 1, calification_cv = :eval WHERE id = :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":id", $id);
        $update->bindParam(":eval", $calificacion);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Actualizacion de datos Exitoso"
            ];
        }
        return [
            "code" => 2,
            "msg" => "Error al Actualizar los Datos"
        ];
    }
    function edit_cv_result_applicant($id, $calificacion, $estado) {
        global $pdo;
        $sql = "UPDATE applicants SET accepted = :state, calification_cv = :eval WHERE id = :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":state", $estado);
        $update->bindParam(":eval", $calificacion);
        $update->bindParam(":id", $id);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Actualizacion de datos Exitoso"
            ];
        }
        return [
            "code" => 2,
            "msg" => "Error al Actualizar los Datos"
        ];
    }
    function edit_interview_result_applicant($id, $calificacion, $estado = null) {
        global $pdo;
        if($estado == null) {
            $sql = "UPDATE applicants SET calification_interview = :eval WHERE id = :id";
            $update = $pdo->prepare($sql);
        }else {
            $sql = "UPDATE applicants SET accepted = :state, calification_interview = :eval WHERE id = :id";
            $update = $pdo->prepare($sql);
            $update->bindParam(":state", $estado);
        }
        $update->bindParam(":eval", $calificacion);
        $update->bindParam(":id", $id);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Actualizacion de datos Exitoso"
            ];
        }
        return [
            "code" => 2,
            "msg" => "Error al Actualizar los Datos"
        ];
    }

    function decline_applicant($id, $eval = 0) {
        global $pdo;
        $sql = "UPDATE applicants SET accepted = 2, calification_cv = :eval WHERE id = :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":id", $id);
        $update->bindParam(":eval", $eval);
        if($update->execute()) {
            return [
                "code" => 1,
                "msg" => "Actualizacion de datos Exitoso"
            ];
        }
        return [
            "code" => 2,
            "msg" => $update->errorInfo()
        ];
    }
    function get_fechas_convocatoria() {
        global $pdo;
        $sql = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) from announcements) AND state=1";
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll();
        return $resultado;
    }
    function get_workplaces_users() {
        global $pdo;
        $sql = "SELECT * FROM workplaces WHERE id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }
        return null;
    }
}else {
    require(PATH_CONN_DB);
    function get_documents_users() {
        global $pdo;
        $sql = "SELECT * FROM documents where id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll();
        return $resultado;
    }
    function get_fechas_convocatoria() {
        global $pdo;
        $sql = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) from announcements) AND state=1";
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll();
        return $resultado;
    }
    function get_workplaces_users() {
        global $pdo;
        $sql = "SELECT * FROM workplaces WHERE id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }
        return null;
    }
    function verify_count_dni($dni) {
        // global $pdo;
        // $sql = "SELECT COUNT(dni) FROM applicants WHERE dni = :dni AND id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
        // $insert = $pdo->prepare($sql);
        // $insert->bindParam(":dni", $dni);
        // if($insert->execute()){
        //     return $insert->fetchAll()[0];
        // }
        // return null;
        return true;
    }
    function set_applicant($nombres, $apellidos, $dni, $id_plaza, $telefono, $documento) {
        global $pdo;
        $result_verify = verify_count_dni($dni);
        if($result_verify != null) {
            $tipo_documento = $documento['type'];
            $ruta_temporal = $documento['tmp_name'];
            $hoy = date("Y-m-d G:i:s");
            $hoy_hora = time();
            $extension = explode("/", $tipo_documento)[1];
            if( $extension == 'pdf' || $extension == 'octet-stream' || $extension == 'x-zip-compressed') {
            $destino = PATH_FILES . "//applicants//" . $dni . " - " . $hoy_hora . "." . explode(".", $documento['name'])[1];
            $nombre_archivo = $dni . " - " . $hoy_hora . "." . explode(".", $documento['name'])[1];
                if(move_uploaded_file($ruta_temporal, $destino)) {
                    // "El archivo se subio correctamente";
                    $sql = "INSERT INTO applicants(
                        id_workplace,
                        dni,
                        name,
                        lastname,
                        phone,
                        path,
                        datetime,
                        id_denomination,
                        accepted,
                        method)
                        VALUES (
                        :id_plaza,
                        :dni,
                        :nombres,
                        :apellidos,
                        :telefono,
                        :documento,
                        NOW(),
                        (SELECT MAX(id) from announcements WHERE state = 1),
                        0,
                        1)";
                    $insert = $pdo->prepare($sql);
                    $insert->bindParam(":id_plaza", $id_plaza);
                    $insert->bindParam(":dni", $dni);
                    $insert->bindParam(":nombres", $nombres);
                    $insert->bindParam(":apellidos", $apellidos);
                    $insert->bindParam(":telefono", $telefono);
                    $insert->bindParam(":documento", $nombre_archivo);
                    if($insert->execute()){
                        return ["code" => "1", "msg" => "exito al registrar al aplicante"];
                    }
                    return ["code" => "2", "msg" => $insert->errorInfo()];
                }else {
                    echo "Ocurrio un problema al subir el archivo";
                    var_dump($insert->errorInfo());
                    // volver('upload_fail');
                }
            }else {
                // volver("format_invalid");
            }
        }
    }
    function get_vacantes() {
        global $pdo;
        $sql = "SELECT work_position FROM workplaces WHERE id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
        $query = $pdo->prepare($sql);
        if($query->execute()) {
            return $query->fetchAll();
        }else {
            return null;
        }

    }
}

function set_applicant_presencial($nombres, $apellidos, $dni, $id_plaza, $telefono, $documento) {
    global $pdo;
    $result_verify = verify_count_dni($dni);
    if($result_verify != null) {
        $tipo_documento = $documento['type'];
        $ruta_temporal = $documento['tmp_name'];
        $hoy = date("Y-m-d G:i:s");
        $hoy_hora = time();
        $extension = explode("/", $tipo_documento)[1];
        if( $extension == 'pdf' || $extension == 'octet-stream' || $extension == 'x-zip-compressed') {
        $destino = PATH_FILES . "//applicants//" . $dni . " - " . $hoy_hora . "." . explode(".", $documento['name'])[1];
        $nombre_archivo = $dni . " - " . $hoy_hora . "." . explode(".", $documento['name'])[1];
            if(move_uploaded_file($ruta_temporal, $destino)) {
                // "El archivo se subio correctamente";
                $sql = "INSERT INTO applicants(
                    id_workplace,
                    dni,
                    name,
                    lastname,
                    phone,
                    path,
                    datetime,
                    id_denomination,
                    accepted,
                    method)
                    VALUES (
                    :id_plaza,
                    :dni,
                    :nombres,
                    :apellidos,
                    :telefono,
                    :documento,
                    NOW(),
                    (SELECT MAX(id) from announcements WHERE state = 1),
                    0,
                    2)";
                $insert = $pdo->prepare($sql);
                $insert->bindParam(":id_plaza", $id_plaza);
                $insert->bindParam(":dni", $dni);
                $insert->bindParam(":nombres", $nombres);
                $insert->bindParam(":apellidos", $apellidos);
                $insert->bindParam(":telefono", $telefono);
                $insert->bindParam(":documento", $nombre_archivo);
                if($insert->execute()){
                    return ["code" => "1", "msg" => "exito al registrar al aplicante"];
                }
                return ["code" => "2", "msg" => $insert->errorInfo()];
            }else {
                echo "Ocurrio un problema al subir el archivo";
                var_dump($insert->errorInfo());
                // volver('upload_fail');
            }
        }else {
            // volver("format_invalid");
        }
    }
}

?>


<?php
 // Funciones de Admin
?>

<?php
    include_once '../../src/config.php';
    include_once PATH_CONN_DB;
?>