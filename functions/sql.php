<?php
    include("conexion.php");
    $con = new Conectar("localhost","root","","prestamos");
    $con = $con->obt();
    mysqli_set_charset($con, 'utf8');
    function obtsocios(){
        $sql = "SELECT * FROM SOCIOS";
        $result = $GLOBALS['con']->query($sql);
        return $result;
    }
    function obtsocio($dni){
        $sql = "SELECT * FROM SOCIOS WHERE DNI = '".$dni."'";
        $result = $GLOBALS["con"]->query($sql);
        return $result;
    }
    function obtsocioxdni($dni){
        $sql = "SELECT * FROM SOCIOS WHERE DNI LIKE '%".$dni."%'";
        $result =$GLOBALS["con"]->query($sql);
        return $result;
    }
?>