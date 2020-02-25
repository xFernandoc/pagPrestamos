<?php
    include_once("../socio.php");
    $dni =$_POST["dni"];
    $socio = new Socio();
    $resultado = $socio->exispend_pag($dni,"PENDIENTE");
    echo json_encode(array($resultado->num_rows));
    /*if ($resultado->num_rows>0) {
        echo json_encode(array("no"));
    }else{
        echo json_encode(array("si"));
    }*/

?>