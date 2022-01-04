<?php 

    class conexion{

        private $conexion;

        public function __construct()
        {
            
        }

        public function conectar(){
            $url = "mysql:host=localhost;dbname=crudajax";
            try{
                $this->conexion = new PDO($url,"root","");
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conexion;
            } catch (Exception $e){
                echo "el error es: ".$e;
            }
        }

    }

?>