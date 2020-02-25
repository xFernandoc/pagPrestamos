<?php
    require 'conexion.php';

    class Socio{
        function conectar(){
            $con = new Conectar("localhost","root","","prestamos");
            $con = $con->obt();
            mysqli_set_charset($con, 'utf8');
            return $con;
        }
        function obtsocios(){
            $conexion = $this->conectar();
            $sql = "SELECT * FROM SOCIOS ORDER BY SOCIOS.APELLIDOS";
            $result = $conexion->query($sql);
            return $result;
        }
        function obtsocio($dni){
            $conexion = $this->conectar();
            $sql = "SELECT * FROM SOCIOS WHERE DNI = '".$dni."'";
            $result = $conexion->query($sql);
            return $result;
        }
        function obtsocioxdni($dni){
            $conexion = $this->conectar();
            $sql = "SELECT * FROM SOCIOS WHERE DNI LIKE '%".$dni."%'";
            $result =$conexion->query($sql);
            return $result;
        }
        function addsocio($listdatos=array())
        {
            $conexion = $this->conectar();
            $sql = "INSERT INTO SOCIOS(DNI,NOMBRES,APELLIDOS,FECHA_NAC,FECHA_INSC,CELULAR,DEPARTAMENTO,PROVINCIA,DISTRITO,DOMICILIO,FOTO)
            VALUES('".$listdatos['dni']."','".$listdatos['nombre']."','".$listdatos['apellido']."','".$listdatos['fecha']."','".$listdatos['fecha']."'
            ,'".$listdatos['celular']."','".$listdatos['dep']."','".$listdatos['prov']."','".$listdatos['dist']."','".$listdatos['dom']."','notperfil.png')";
            $result=$conexion->query($sql);
            return $result;
        }
        function existedni($dni){
            $conexion = $this->conectar();
            $sql ="SELECT * FROM SOCIOS WHERE DNI = '".$dni."'";
            $result= $conexion->query($sql);
            return $result->num_rows;
        }
        function obcuotaxpres($id_pres){
            $conexion = $this->conectar();
            $sql ="SELECT * FROM cuota WHERE id_pres = '".$id_pres."'";
            $result= $conexion->query($sql);
            return $result;
        }

        function exispend_pag ($dni,$estado){
            $conexion = $this->conectar();
            $sql ="SELECT * FROM prestamo_soc WHERE id_soci = '".$dni."' AND ESTADO='".$estado."'";
            $result= $conexion->query($sql);
            return $result;
        }
    }
?>