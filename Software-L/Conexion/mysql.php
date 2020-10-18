<?php
$hostname='localhost:3306';
$username='root';
$password='';
$database='hotel';

$conn = mysqli_connect($hostname,$username,$password);
mysqli_select_db($conn, $database);
//mysqli_query("SET NAMES 'utf8'");

if (!$conn){

     echo 'Error: No pudo conectar a la BD '.mysqli_connect_error().PHP_EOL;

}else{
 
    echo 'Conexion Exitoso';

}
?>