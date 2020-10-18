<?php
echo '<h1>Cuarto Software</h1>';

$var = 'Esto es un ejemplo de php';

$valorUno = 5;
$valorDos = 10;


function sumarSinParametros(){
	$valorUno = 2;
	$valorDos = 3;

	return $valorUno + $valorDos;
}
//echo '<br/>'.sumarSinParametros();

function sumarConParametros($valorUno, $valorDos){
	return $valorUno + $valorDos;
}
//echo '<br/>'.sumarConParametros(4, 5);


function restarConParametros($valorUno, $valorDos) {
	return $valorUno - $valorDos;
}
//echo '<br/>'.restarConParametros(4, 5);

function calcularMayor(){
	$valorUno = 2;
	$valorDos = 3;

	if ($valorUno > $valorDos)
		return $valorUno;
	else
		return $valorDos;
}
//echo '<br/>'.calcularMayor();


function metodoFor(){
	for($i=1; $i<=10; $i++){
			echo 'Hola <br/>';
	}		
}
//metodoFor();


function metodoForeach(){
	$estudiantes = ['Felix','Evelyn','Antonella', 'Josselyn'];
	echo '<br/>';
	var_dump($estudiantes[3]);
	echo '<br/>';
	
	foreach($estudiantes as $estudiante){
			echo '<br/>Hola '.$estudiante;
	}
}
//metodoForeach();
function metodoDoWhile(){
	$cont = 1;
	do {
		echo $cont.', ';
		$cont++;
	} while ($cont<=10);
}


function metodoWhile(){
	$cont = 1;
	while($cont<=10){
		echo $cont.', ';
		$cont++;
	}
}
//metodoWhile();


function metodoSwitch(){
	$i = 10;
	switch($i){
			case 1:
				echo 'Es uno';
				break;
			case 2:
				echo 'Es dos';
				break;
			case 3:
				echo 'Es tres';
				break;
			default:
				echo 'Es otro numero';
				
	}
}
metodoSwitch();


//echo 'La suma de '.$valor1.' con '.$valor2.' es:'.($valor1 + $valor2);

?>
