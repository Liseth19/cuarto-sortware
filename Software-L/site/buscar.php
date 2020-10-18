<?php
if (!isset($_SESSION)) session_start();

include('../conexion/mysql.php');

if (!$_SESSION['autenticacion']) {
    header('Location:../401.php');
}
$buscar = $_POST['nombre'];
$sql= "SELECT * FROM usuario WHERE nombre LIKE'%".$buscar."%' OR apellido LIKE '%".$buscar;

$sql_query = mysqli_query($conn, $sql);

?>