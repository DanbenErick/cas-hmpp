<?php
function detectar_vacio(...$variables) {
    foreach($variables as $valor) {
        // echo "Data: " . $valor . "<br>";
        if(empty($valor)) {
            return false;
        }
    }
    return true;
}
?>