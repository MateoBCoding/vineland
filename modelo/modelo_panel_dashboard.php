<?php 

include("../modelo/conexion.php");

$sql = $conexion->query("SELECT count(identrevistado) as totalEva  FROM resultados");
$datos = $sql->fetch_object();

$totalEvaluaciones = $datos->totalEva



?>