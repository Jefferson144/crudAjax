<?php 
    require_once ("conexion.php");

    $primerNombre = $_POST['primerNombre'];
    $primerApellido = $_POST['primerApellido'];
    $telefono = $_POST['telefono'];

    $conexion = new conexion();
    $conexion = $conexion->conectar();

    $sql = "INSERT INTO usuario (primerNombre, primerApellido, numero) VALUES (?,?,?)";
    $datos = array($primerNombre,$primerApellido,$telefono);
    $query = $conexion->prepare($sql);
    $query->execute($datos);
?>
