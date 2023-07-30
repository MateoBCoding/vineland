<?php
if (
  !empty($_SESSION["idrespondedor"]) && !empty($_SESSION["nombreresopondedor"])
  && !empty($_SESSION["sexorespondedor"]) && !empty($_SESSION["relacion"]) && !empty($_SESSION["telefonorespondedor"])
) {

  $identificacion = $_SESSION["idrespondedor"];
  $nombre = $_SESSION["nombreresopondedor"];
  $generoaso = $_SESSION["sexorespondedor"];
  $tefonoaso = $_SESSION["telefonorespondedor"];
  $relacionaso = $_SESSION["relacion"];

  try {
    $resultado = $conexion->query("INSERT INTO respondedor (idrespondet, nombreResponden, sexoresponden, telefonoresponden, id_relacion)
                                VALUES ('$identificacion', '$nombre', '$generoaso', '$tefonoaso', '$relacionaso');");

    if (!$conexion) {
      die("La conexión mysqli se ha cerrado antes de lo esperado.");
    }
  } catch (Exception $e) {
    echo "Error al insertar los datos: " . $e->getMessage();
  }
}
