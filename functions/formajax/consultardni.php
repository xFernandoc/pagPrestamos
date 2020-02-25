<?php
    include_once("simple_dom/simple_html_dom.php");
    $_POST=json_decode(file_get_contents("php://input"),true);
    $consulta = file_get_html('https://eldni.com/buscar-por-dni?dni='.$_POST["dni"]);
    $datos = array();
    foreach ($consulta->find("td") as $value) {
        $datos [] = $value->plaintext;
    }
    echo json_encode($datos);
?>