<?php

require_once("conexion.php");

if (isset($_REQUEST['idUser'])) {
    $id = $_REQUEST['idUser'];

    $conexion = new conexion();
    $conexion = $conexion->conectar();

    $sql = "SELECT * FROM usuario WHERE idUsuario = '" . $id . "'";
    $query = $conexion->prepare($sql);
    $query->execute();
    $registro = $query->fetch(PDO::FETCH_ASSOC);

    $primerNombre = $registro['primerNombre'];
    $primerApellido = $registro['primerApellido'];
    $telefono = $registro['numero'];
}
?>

<div class="modal fade" id="actualizarUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- formulario -->
            <form id="actuUserForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <!-- Id del usuario -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" value="<?= $id ?>" name="actuidUser" id="actuidUser" class="form-control">
                            </div>
                        </div>
                        <!-- advertencia : LOS ID, FOR, NAME TIENE QUE SER DIFERENTE YA QUE ESTE ES
                    LLAMADO POR ENDE SI HAY OTRO FORMULARIO QUE TIENE LOS MISMO NOMBRES HABRA ERROR CUANDO LOS LLAMEMOS
                EN EL IF DEL SCRIPT SI ESTAN VACIOS.  -->
                        <!-- primer Nombre -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="actuprimerNombre">Primer nombre</label>
                                <input type="text" id="actuprimerNombre" name="actuprimerNombre" class="form-control" value="<?= $primerNombre ?>" minlength="0" maxlength="45" pattern="[a-zA-Z]+">
                            </div>
                        </div>
                        <!-- primer Apellido -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="actuprimerApellido">Primer Apellido</label>
                                <input type="text" id="actuprimerApellido" name="actuprimerApellido" class="form-control" value="<?= $primerApellido ?>" minlength="0" maxlength="45" pattern="[a-zA-Z]+">
                            </div>
                        </div>
                        <!-- numero -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="actunumero">Numero</label>
                                <input type="text" id="actunumero" name="actunumero" class="form-control" value="<?= $telefono ?>" minlength="0" maxlength="45" pattern="[0-9]+">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        /* inicializamos nuestro documento nuevo con ready */
        $('#actuUserForm').submit(function(e) {
            /* le damos prioridad a nuestro formulario mediante mediante el evento submit */
            e.preventDefault(); /* sintaxis */
            
            /* var id = $('#actu_idUser').val(); */
            var primerNombre = $('#actuprimerNombre').val();
            var primerApellido = $('#actuprimerApellido').val();
            var numero = $('#actunumero').val();
            /* abra error si lo llamamos igual a la hora de traer los datos con el id */
            if (primerNombre.length == 0 || primerApellido.length == 0 || numero.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ha ocurrido un error',
                    text: 'intenta nuevamente',
                })
            } else {
                Swal.fire({
                    title: 'Actualizacion',
                    text: "¿ Esta seguro de actualizar usuario ?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: './modelo/actualizarUser.php',
                            type: 'POST',
                            data: $(this).serialize()/* {actu_idUser:id,actu_primerNombre:primerNombre, actu_primerApellido:primerApellido,actunumero:numero} */,
                            cache: false,
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Actualizacion',
                                    text: 'se actualizo con exito',
                                    timer: 1000,
                                    showConfirmButton: false,
                                }).then(()=>{
                                    window.location.reload();
                                })
                            }
                        })
                    }
                })
            }
        })
    })
</script>