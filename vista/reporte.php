<?php
//aqui necesito tomar los datos de la base de datos
include("../modelo/conexion.php");


$idresultados = $_GET['id'];
$sql = $conexion->query("SELECT * FROM resultados Where idresultados=$idresultados;");
$datos = $sql->fetch_object();

if ($datos) {
    $v_raw1 = $datos->Vraw_1;
    $v_raw2 = $datos->Vraw_2;
    $v_raw3 = $datos->Vraw_3;
    $v_raw4 = $datos->Vraw_4;
    $v_raw5 = $datos->Vraw_5;
    $v_raw6 = $datos->Vraw_6;
    $v_raw7 = $datos->Vraw_7;
    $v_raw8 = $datos->Vraw_8;
    $v_raw9 = $datos->Vraw_9;
    $v_raw10 = $datos->Vraw_10;
    $v_raw11 = $datos->Vraw_11;

    $v_raw_values = array($v_raw1, $v_raw2, $v_raw3, $v_raw4, $v_raw5, $v_raw6, $v_raw7, $v_raw8, $v_raw9, $v_raw10, $v_raw11);

    $json_data = json_encode($v_raw_values);

    // Imprimir el JSON para verificarlo

}

?>

<!-- luego se carga el sidebar -->

<head>
    <link rel="stylesheet" href="../public/app/publico/css/lib/datatables-net/datatables.min.css">
    <link rel="stylesheet" href="../public/app/publico/css/separate/vendor/datatables-net.min.css">

    <link href="../public/app/publico/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../public/app/publico/css/main.css" rel="stylesheet">
    <link href="../public/app/publico/css/mis_estilos/estilos.css" rel="stylesheet">

    <!-- form -->
    <link rel="stylesheet" type="text/css" href="../public/app/publico/css/lib/jquery-flex-label/jquery.flex.label.css"> <!-- Original -->

    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- mis estilos -->
    <link href="../public/principal/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="../vista/inicio/css/preguntas.css">
    <link rel="stylesheet" href="../vista/inicio/css/pbar.css" type="text/css" />
    <link rel="stylesheet" href="../vista/inicio/css/step-wizard.css" type="text/css" />

    <!-- pNotify -->
    <link href="../public/pnotify/css/pnotify.css" rel="stylesheet" />
    <link href="../public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
    <link href="../public/pnotify/css/custom.min.css" rel="stylesheet" />

    <!-- google fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- pnotify -->
    <script src="../public/pnotify/js/jquery.min.js">
    </script>
    <script src="../public/pnotify/js/pnotify.js">
    </script>
    <script src="../public/pnotify/js/pnotify.buttons.js">
    </script>
    <script src="https://d3js.org/d3.v7.min.js"></script>

    <!-- alpine js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- chart js -->
    <script src="../public/chart/chart.js"></script>

    <script src="../vista/inicio/js/pbar.js" defer></script>

</head>
<!-- inicio del contenido principal -->


<body>

    <div class="page-content">
        <section>
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th scope="col">Subdominio</th>
                        <th scope="col">Raw Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Subdominio</th>
                        <th>Raw Score</th>
                    </tr>
                    <tr>
                        <td>Receptiva</td>
                        <td><?= $datos->Receptiva ?></td>
                    </tr>
                    <tr>
                        <td>Expresiva</td>
                        <td><?= $datos->Expresiva ?></td>
                    </tr>
                    <tr>
                        <td>Escritura</td>
                        <td><?= $datos->Escritura ?></td>

                    </tr>
                    <tr>
                        <td>Personal</td>
                        <td><?= $datos->Personal ?></td>

                    </tr>
                    <tr>
                        <td>Domestico</td>
                        <td><?= $datos->Domestico ?></td>

                    </tr>
                    <tr>
                        <td>Comunitario</td>
                        <td><?= $datos->Comunitario ?></td>

                    </tr>
                    <tr>
                        <td>Relaciones interpersonales</td>
                        <td><?= $datos->Relaciones_Interpersonales ?></td>

                    </tr>
                    <tr>
                        <td>Juego</td>
                        <td><?= $datos->Juego_y_tiempo_libre ?></td>

                    </tr>
                    <tr>
                        <td>Habilidades de Afrontamiento</td>
                        <td><?= $datos->Habilidades_afrontamiento ?></td>

                    </tr>
                    <tr>
                        <td>Motricidad Gruesa</td>
                        <td><?= $datos->Motricidad_Gruesa ?></td>

                    </tr>
                    <tr>
                        <td>Fina</td>
                        <td><?= $datos->Motricidad_Fina ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            include("../modelo/conexion.php");
            ?>
        </section>

        <section style="width: 700px;">
            <canvas id="grafico" width="200" height="200"></canvas>
            <!-- fin del contenido principal -->

            <script>
                var jsonData = '<?php echo $json_data; ?>';

                // Convertir el JSON a un objeto JavaScript
                var dataArray = JSON.parse(jsonData);
                var canvas = document.getElementById('grafico');
                var ctx = canvas.getContext('2d');

                // Definir los datos para el gráfico
                var data = {
                    labels: ["Receptiva", "Expresiva", "Escritura", "Personal", "Domestico", "Comunitario", "Relaciones Interpersonales", "Juego Y Tiempo Libre", "Habilidades de Afrontamiento", "Gruesa", "Fina"],
                    datasets: [{
                        label: 'Valores v_raw',
                        data: dataArray,
                        backgroundColor: 'rgba(0, 123, 255, 0.5)', // Color de fondo de las barras
                        borderColor: 'rgba(0, 123, 255, 1)', // Color del borde de las barras
                        borderWidth: 1 // Ancho del borde de las barras
                    }]
                };
                // Crear el gráfico de barras
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: {
                        indexAxis: "y",
                        scales: {
                            x: {
                                beginAtZero: true // Iniciar el eje Y en 0
                            }
                        }
                    }
                });
            </script>
        </section>
    </div>

</body>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>

<?php

require_once "../vista/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true); // Habilitar la carga de archivos CSS remotos
$dompdf->loadHtml($html);
$dompdf->render();



// Output the generated PDF to Browser
$dompdf->stream("archivo_reporte.pdf",array("Attachment" => false));
?>