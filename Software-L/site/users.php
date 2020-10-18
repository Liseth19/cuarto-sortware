<?php
if (!isset($_SESSION)) session_start();

include('../conexion/mysql.php');

if (!$_SESSION['autenticacion']){
    header('Location:../401.php');
}

$accion = (isset($_POST['action']))?$_POST['action']:null;

if ($accion == 'save') {
    $nombre = (isset($_POST['nombre'])?$_POST['nombre']:null);
    $apellido = (isset($_POST['apellido'])?$_POST['apellido']:null);
    $username = (isset($_POST['username'])?$_POST['username']:null);
    $contrasena = (isset($_POST['contrasena'])?md5($_POST['contrasena']):null);
    $hoy = date('Y-m-d H:i:s');

    $sql = "INSERT INTO usuario (nombre, apellido, username, password, activo, fecha_creacion) VALUES('$nombre', '$apellido', '$username', '$contrasena', '1', '$hoy')";
    mysqli_query($conn, $sql);

}else if ($accion == 'update') {
    $nombre = (isset($_POST['nombre'])?$_POST['nombre']:null);
    $apellido = (isset($_POST['apellido'])?$_POST['apellido']:null);
    $username = (isset($_POST['username'])?$_POST['username']:null);
    $id = (isset($_POST['id'])?$_POST['id']:null);

    $sql = "UPDATE usuario SET nombre='$nombre',  apellido='$apellido', username='$username' WHERE id=$id";
    mysqli_query($conn, $sql);

} else {
    $id = (isset($_GET['id']))?$_GET['id']:null;
    $sql = "DELETE FROM usuario WHERE id=$id";
    mysqli_query($conn, $sql);
}

unset($_POST['action']);

?>

<html>
	<head>
        <link rel="stylesheet" href="../libs/bootstrap-4.5.0/css/bootstrap.min.css">
	</head>

	<body>
        <div class="container">
            <?php include('components/navbar.php'); ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nuevo</button>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            </form>
                    <form action=buscar.php method="post">
                    <input type="text" name="nombre" placeholder="Buscar apellido">
                    <input type="submit" name ="nombre" value = "nombre">
                    </form>
                    
				

            <!-- Modal -->
            <form method="post" action="users.php" onSubmit="return validarCampos()">
                <input type="hidden" name="action" value="save">
                <div class="modal fade" id="exampleModal" name="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nombres:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Ingrese su nombre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Apellidos:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="apellido" name="apellido" value="" placeholder="Ingrese su apellido" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Username:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="" placeholder="Ingrese su nombre de usario" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contraseña:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" value="" placeholder="Ingrese la contraseña" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Repetir Contraseña:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="recontrasena" name="recontrasena" value="" placeholder="Repetir la contraseña" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button class="btn btn-primary">Guardar</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>

            <h3>Lista de Usuarios</h3>
            <?php
            $sql = "SELECT * FROM usuario";
            $query = mysqli_query($conn, $sql);
            $usuario_array = mysqli_fetch_assoc($query);
            $tot_rows = mysqli_num_rows($query);

            if ($tot_rows>0) {
            ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    do {
                    ?>
                    <tr>
                        <td><?php echo $usuario_array['id']; ?></td>
                        <td><?php echo $usuario_array['nombre']; ?></td>
                        <td><?php echo $usuario_array['apellido']; ?></td>
                        <td><?php echo $usuario_array['username']; ?></td>
                        <td><?php if ($usuario_array['activo']==1) { echo 'SI'; }else { echo 'NO'; }?></td>
                        <td>   
                            <div class="btn-group">
                                <a href="update-user.php?id=<?php echo $usuario_array['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                <a href="users.php?id=<?php echo $usuario_array['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                    } while ($usuario_array = mysqli_fetch_assoc($query));
                    
                     if ($usuario_array) { 
                    mysqli_free_result($usuario_array);
                     }
                    ?>
                </tbody>
            </table>
            
            <?php
            } else {
                echo 'No existen usuarios registrados.';
            }
            ?>
        </div>
        
    </body>
	<script type="text/javascript" src="../libs/jquery/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="../libs/bootstrap-4.5.0/js/bootstrap.min.js"></script>
    <script>
        function validarCampos() {
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var username = $('#username').val();
            var contrasena = $('#contrasena').val();
            var re_contrasena = $('#recontrasena').val();

            if (nombre == ""){
                alert('Por favor ingrese el nombre');
                $('#nombre').focus();
                return false;
            } else if (apellido == "") {
                alert('Por favor ingrese el apellido');
                $('#apellido').focus();
                return false;
            } else if (username == ""){
                alert('Por favor ingrese el nombre de usuario');
                $('#username').focus();
                return false;
            } else if (contrasena == "") {
                alert('Por favor ingrese la contraseña');
                $('#contrasena').focus();
                return false;
            } else if(contrasena != re_contrasena){
                alert('Las contraseñas no coinciden');
                return false;
            } else {
                return true;
            }
        }

    </script>
</html>