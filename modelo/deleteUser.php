<?php 
    require_once ("conexion.php");

    if (isset($_REQUEST['idUser'])){
        $id = $_REQUEST['idUser'];

        $conexion = new conexion();
        $conexion = $conexion->conectar();

        $sql = "DELETE FROM usuario WHERE idUsuario = '".$id."'";
        $query = $conexion->prepare($sql);
        $query->execute();
    }
?>