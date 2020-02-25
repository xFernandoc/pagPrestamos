<?php
    class Conectar{
        private $server="";
        private $user="";
        private $pass="";
        private $bd="";

        public function __construct($server , $user , $pass , $bd)
        {
            $this->server=$server;
            $this->user=$user;
            $this->pass=$pass;
            $this->bd=$bd;
        }

        function obt (){
            return new mysqli($this->server,$this->user,$this->pass,$this->bd);
        }
    }
?>