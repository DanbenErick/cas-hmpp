<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1 ){
        require_once("../../src/config.php");
        require_once(PATH_CONN_DB);

        $sql = "UPDATE users SET state = 1 WHERE id = :id";
        $update = $pdo->prepare($sql);
        $update->bindParam(":id", $_GET['id']);
        if($update->execute()) {
            header("Location: ../admin/index.php?alert=ok");
        }else {
            header("Location: ../admin/index.php?alert=fail_edit");
        }
    }else {
        header("Location: ../index.php");
    }
?>