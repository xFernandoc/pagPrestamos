<?php
    $dni = $_POST["busq"];
    include_once("../socio.php");
    $socio = new Socio();
    echo $socio->existedni($dni);
?>