<?php
if (!isset($_SESSION)) session_start();

if (!$_SESSION['autenticacion']){
    header('Location:../401.php');
}
?>

<html>
	<head>
        <link rel="stylesheet" href="../libs/bootstrap-4.5.0/css/bootstrap.min.css">
	</head>

	<body>
        <div class="container">
            <?php include('components/navbar.php'); ?>   
            <h3>Home</h3>
        </div>
    </body>
	<script src="../libs/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="../libs/bootstrap-4.5.0/js/bootstrap.bundle.min.js"></script>
	<script src="../libs/bootstrap-4.5.0/js/bootstrap.min.js"></script>
</html>