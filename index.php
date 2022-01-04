<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD CON AJAX</title>
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./sweetAlerts2/sweetalert2.min.css">
</head>

<body>
    <header>

    </header>
    <main>
        <div class="container-fluid bg-primary py-2 text-center">
            <h3>CRUD BOOTSTRAP</h3>
        </div>

        <div class="container mt-5">
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addUser">Añadir usuario</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id de usuario</th>
                        <th>Primer nombre</th>
                        <th>Prime apellido</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once ("./modelo/conexion.php");
                        $objeto = new conexion();
                        $objeto = $objeto->conectar();
                        $sentencia = "SELECT * FROM usuario";
                        $query = $objeto->prepare($sentencia);
                        $query->execute();
                        while ($registro = $query->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <tr>
                              <td><?= $registro['idUsuario']?></td>
                              <td><?= $registro['primerNombre']?></td>
                              <td><?= $registro['primerApellido']?></td>
                              <td><?= $registro['numero']?></td>
                              <td>
                                  <button type="button" class="btn btn-warning btn-sm actualizarUser" id="<?= $registro['idUsuario'] ?>">Editar</button>
                                  <button type="button" class="btn btn-danger btn-sm eliminarUser" id="<?= $registro['idUsuario'] ?>">Eliminar</button>
                              </td>
                          </tr>
                          <!-- echo "<tr>";
                            echo "<td>".$registro['idUsuario']."</td>";
                            echo "<td>".$registro['primerNombre']."</td>";
                            echo "<td>".$registro['primerApellido']."</td>";
                            echo "<td>".$registro['numero']."</td>";
                            echo "<td></td>";
                          echo "</tr>"; -->
                          <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="addUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addUserForm" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <!-- Primer nombre-->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="primerNombre">Primer nombre</label>
                                        <input type="text" id="primerNombre" name="primerNombre" class="form-control" minlength="0" maxlength="45" pattern="[a-zA-Z]+">
                                    </div>
                                </div>
                                <!-- Primer apellido -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="primerApellido">Primer apellido</label>
                                        <input type="text" id="primerApellido" name="primerApellido" class="form-control" minlength="0" maxlength="45" pattern="[a-zA-Z]+">
                                    </div>
                                </div>
                                <!-- telefono -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" id="telefono" name="telefono" class="form-control" minlength="0" maxlength="10" pattern="[0-9]+">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">cerrar</button>
                            <button type="submit" class="btn btn-success">Añadir usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Esta caja es para actualizar donde se visualizara el modal del formulario actualizar -->
        <div id="mostrar_user"></div>
    </main>
    <footer>

    </footer>

    <script src="bootstrap-4.6.0-dist/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="js/crud.js"></script>
    <script src="sweetAlerts2/sweetalert2.all.min.js"></script>
</body>

</html>