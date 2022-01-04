<?php 

    require_once ("conexion.php");
    
    /* if (isset($_REQUEST['actu_idUser']) && isset($_REQUEST['actu_primerNombre']) && isset($_REQUEST['actu_primerApellido']) && isset($_REQUEST['actunumero'])){
        $id = $_REQUEST['actu_idUser'];
        $primerNombre = $_REQUEST['actu_primerNombre'];
        $primerApellido = $_REQUEST['actu_primerApellido'];
        $numero = $_REQUEST['actunumero'];
        $conexion = new conexion();
    $conexion = $conexion->conectar();

    $sql = "UPDATE usuario SET primerNombre = '".$primerNombre."', primerApellido = '".$primerApellido."', numero = '".$numero."' WHERE idUsuario = '".$id."'";
    $query = $conexion->prepare($sql);
    $query->execute();
    } */

    $id = $_POST['actuidUser'];
    $primerNombre = $_POST['actuprimerNombre'];
    $primerApellido = $_POST['actuprimerApellido'];
    $numero = $_POST['actunumero'];

    $conexion = new conexion();
    $conexion = $conexion->conectar();

    $sql = "UPDATE usuario SET primerNombre = '".$primerNombre."', primerApellido = '".$primerApellido."', numero = '".$numero."' WHERE idUsuario = '".$id."'";
    $query = $conexion->prepare($sql);
    $query->execute();

?>