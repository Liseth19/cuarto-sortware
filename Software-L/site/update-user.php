<?php
if (!isset($_SESSION)) session_start();

include('../conexion/mysql.php');

if (!$_SESSION['autenticacion']) {
    header('Location:../401.php');
}

$id = (isset($_GET['id']))?$_GET['id']:null;

if ($id > 0) {
    $sql = "SELECT nombre, apellido, username FROM usuario WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    unset($_GET['id']);
}
?>

<html>
	<head>
        <link rel="stylesheet" href="../libs/bootstrap-4.5.0/css/bootstrap.min.css">
	</head>

	<body>
        <div class="container">
        <?php include('../site/components/navbar.php'); ?>

        <h3>Editar usuario</h3>
        <form method="post" action="users.php">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="modal-footer">
                <a href="users.php" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                <button class="btn btn-primary" type="submit">Actualizar</button>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nombres:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" placeholder="Ingrese su nombre">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Apellidos:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" placeholder="Ingrese su apellido">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" placeholder="Ingrese su nombre de usario">
                </div>
            </div>          
        </form>
    </body>
    <script type="text/javascript" src="../libs/jquery/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="../libs/bootstrap-4.5.0/js/bootstrap.min.js"></script>
</html>