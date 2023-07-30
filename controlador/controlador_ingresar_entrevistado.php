<?php

$idrespon = $_SESSION["idrespondedor"];
$identificacion= $_SESSION["identrevistado"];
$nombrecompleto = $_SESSION["nombre"];
$fecha_n =$_SESSION["fecha_n"];
$email = $_SESSION["email"];
$telef =$_SESSION["telefono"];
$genero =$_SESSION["sexo"];
$grado =$_SESSION["grado"];
$colegio =$_SESSION["colegio"];
$diagnosis =$_SESSION["diagnosis"];
$edadcronologica =$_SESSION["edad"];
$razon =$_SESSION["razon"];



try {
    $sql = "INSERT INTO entrevistados(cedula, idrespon, nombre, idgenero, grado, colegiouotros, diagnosis, fechanacimiento, edad_cronologica, razon_entrevista) 
            VALUES('$identificacion', '$idrespon', '$nombrecompleto', '$genero', '$grado', '$colegio', '$diagnosis', '$fecha_n', '$edadcronologica', '$razon')";
    
    $conexion->query($sql);

    // Verificar si se insertaron filas correctamente
    if ($conexion->affected_rows > 0) {
        echo "Datos insertados correctamente.";
        
    } else {
        echo "No se pudieron insertar los datos.";
    }
} catch (Exception $e) {
    echo "Error al insertar los datos: " . $e->getMessage();
}
?>