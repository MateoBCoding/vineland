<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header('location:login/login.php');
}
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->

<?php
include("../modelo/conexion.php");

$sql = $conexion->query("SELECT ent.nombre,ent.fechanacimiento, 
respo.nombreResponden, ent.cedula,r.idresultados  
FROM `resultados` as r
JOIN entrevistados as ent ON r.identrevistado = ent.cedula 
JOIN respondedor as respo ON ent.idrespon = respo.idrespondet 
")
?>

<div class="page-content">

  <table class="table table-bordered table-hover col-14" id="example">
    <thead>
      <tr>
        <th scope="col">Id de rsultados</th>
        <th scope="col">Cedula Entrevistado</th>
        <th scope="col">Nombre Entrevistado</th>
        <th scope="col">Fecha Nacimiento</th>
        <th scope="col">Nombre Acudiente</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td><?= $datos->idresultados?></td>
          <td><?= $datos->cedula ?></th>
          <td><?= $datos->nombre ?></td>
          <td><?= $datos->fechanacimiento ?></td>
          <td><?= $datos->nombreResponden ?></td>
          <td>
            <a href="../vista/reporte.php?id=<?=$datos->idresultados ?>" target="_blank" class="btn btn-succes">
              <i class="fa-solid fa-file-pdf"></i>
            </a>
          </td>
        </tr>
      <?php }
      ?>
    </tbody>
  </table>
</div>

<!-- fin del contenido principal -->





<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>