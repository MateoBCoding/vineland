<?php 

include("../modelo/conexion.php");

$sql = $conexion->query("SELECT count(identrevistado) as totalEva  FROM resultados");
$datos = $sql->fetch_object();

$totalEvaluaciones = $datos->totalEva;

$sql2 = $conexion->query("SELECT count(cedula) as totalEnt FROM entrevistados");
$datos = $sql2->fetch_object();

$totalEnt = $datos->totalEnt;



?>