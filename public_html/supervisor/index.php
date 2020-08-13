<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):?>
<?php
date_default_timezone_set("America/Lima");
require("../../src/config.php");
require("../php/functions/functions.php");
require(PATH_TEMPLATE  .'/headers_supervisor.php');
require(PATH_TEMPLATE. '/nav.php');
$resultado_aplicantes = get_applicants_super();
$sql = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) from announcements) AND state=1";
$result = $pdo->prepare($sql);
if($result->execute()) {
    $convocatory = $result->fetchAll()[0];
}
$sql2 = "SELECT * FROM workplaces WHERE id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)";
$result2 = $pdo->prepare($sql2);
if($result2->execute()) {
    $workplaces = $result2->fetchAll();
}else {
    var_dump($result2->errorInfo());
}

require(PATH_TEMPLATE. '/section_supervisor.php');
?>


<script src="../js/alert.js"></script>
<script>
    formFilter.addEventListener("change", function(e) {
        e.preventDefault()
        console.log(e.target.value)
        window.location = `./index.php?filter=${e.target.value}`
    })
    <?php
        if(@$_GET['alert'] !=  null) {
            switch($_GET['alert']){
                case 'success_accept':
                    echo "successAccept()";
                    break;
                case 'error_accept':
                    echo "errorAccept()";
                    break;
                case 'success_decline':
                    echo "successDecline()";
                    break;
                case 'error_decline':
                    echo "errorDecline()";
                    break;
            }
        }
        ?>
</script>
<?php
require(PATH_TEMPLATE. '/modal.php');

?>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):  header("Location: ../sistema") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>
