<?php
if (!isset($_SESSION)) session_start();

include('Conexion/mysql.php');

$username =  isset($_POST['username'])? $_POST['username']:null;
$password = isset($_POST['password'])? $_POST['password']:null;

if ($username!=null && $password!=null) {

	

	$sql = "SELECT * FROM usuario WHERE username='".$username."' AND password='".$password."'";
	$query = mysqli_query($conn, $sql);
	$tot_rows = mysqli_num_rows($query);




	if($tot_rows){
		   $_SESSION['autenticacion']=true;

	    header ('Location:site');
    }else{
	    header ('Location:index.php?wrong=wd');
    }
	unset($username);
	unset($password);
}
?>

<html>
	<head>
	      <link rel="stylesheet" href="libs/bootstrap-4.5.0/css/bootstrap.min.css"> 
	</head>
	<body style="background:grey;">
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4" style="background:#fff; margin-top:100px; padding:15px">
				<form method="POST" action="index.php">
				  <div class="form-group">
					<label>Username</label>
					<img class="glypicon glypicon-user">
					<input type="text" class="form-control" name="username" pattern="[A-Za-z0-9_-]{1,16}" placeholder="Ingrese su usuario" required>				  
				  </div>
				  <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" pattern="[A-Za-z0-9_-]{1,16}" placeholder="Ingrese la contraseña" required>
				  </div>
				  <div class="form-group form-check">
					<input type="checkbox" class="form-check-input">
					<label class="form-check-label" for="exampleCheck1">Rocordarme</label>
				  </div>
				  <?php
                    	if((isset($_GET['wrong'])) && ($_GET['wrong']=='wd')) {
							echo '<div class="alert alert-danger" role="alert">Credenciales incorrectas</div>'; 
						}
					
				  ?>
			
				  <button type="submit" class="btn btn-primary">Ingresar</button>
				    
				</form>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		
	</body>
	<script src="libs/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="libs/bootstrap-4.5.0/js/bootstrap.bundle.min.js"></script>
	<script src="libs/bootstrap-4.5.0/js/bootstrap.min.js"></script>
	
</html>
