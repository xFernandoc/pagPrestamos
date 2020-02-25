<?php
    include_once("../socio.php");
    
    $dni= $_POST["txtdocumento"];
    $nombre= ucwords(mb_strtolower($_POST["txtNombre"],"UTF-8"));
    $apellido=  ucwords(mb_strtolower($_POST["txtApellido"],"UTF-8"));
    $fecha= $_POST["fecha_nac"];
    $celular=  $_POST["celular"];
    $dep= $_POST["txtdep"];
    $prov= $_POST["txtprov"];
    $dist= $_POST["txtdist"];
    $dom=$_POST["txtdomc"];
    $datos = array(
        "dni"=>$dni,
        "nombre"=>$nombre,
        "apellido"=>$apellido,
        "fecha"=>$fecha,
        "celular"=>$celular,
        "dep"=>$dep,
        "prov"=>$prov,
        "dist"=>$dist,
        "dom"=>$dom
    );
    $socio = new Socio();
    if ($socio->addsocio($datos)) {
        echo "Exito";
    }
?>