<?php session_start();
if(@$_SESSION['id_user']):
    if($_SESSION['id_rol'] == 1){
        header("Location: ./sistema/");
    }else if($_SESSION['id_rol'] == 2) {
        header("Location: ./supervisor/");
    }
?>
<?php else:?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar</title>
    <link rel="stylesheet" href="css/style-sistema.css?v=1">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <section class="section-ingreso-sistema">
        <div class="container">
            <div class="contenedor-form">
                <h1>INGRESO AL SISTEMA</h1>
                <form action="php/login.php" method="post" id="formLogin">
                    <div class="grupo-input">
                        <input type="text" placeholder="Usuario" name="Usuario"></div>
                    <div class="grupo-input">
                        <input type="password" placeholder="Clave" name="Password">
                    </div>
                    <div class="grupo-input">
                    <button class="g-recaptcha btn btn-primary" data-sitekey="6LeugNkUAAAAAJ5T7aidfAWwSiO0Gl5POtXZDyjc" data-callback="submitForm"
                    name="login">Ingresar</button>
                        <!-- <button type="submit" name="login" value="login">Ingresar</button> -->
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php if(@$_GET['alert'] != null):?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/alert.js"></script>
        <script>
            <?php

                switch($_GET['alert']) {
                    case 'empty_camps':
                        echo "emptyInputs()";
                        break;
                    case 'fail_credentials':
                        echo "failCredentials()";
                        break;
                    case 'fail':
                        echo "failLogin()";
                        break;
                    case 'not_validate_captcha':
                        echo "notValidate()";
                        break;
                }

            ?>
        </script>
    <?php endif;?>
    <script>
        function submitForm() {
            document.getElementById('formLogin').submit();
        }
    </script>
</body>
</html>

<?php endif;?>