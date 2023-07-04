<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
if (empty($_SESSION['fina'])) {
    if ($_GET["total"] != null) {

        $total = $_GET["total"];

        $_SESSION['fina'] = $total;
    }
}
?>


<?php require('../modelo/modelo_obtener_datos_tablas.php'); ?>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>
<!-- inicio del contenido principal -->
<style>
    section {
        background-color: #ddd;
        padding: 20px;
        border-radius: 10px;
    }
</style>

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
                        <td><?= $_SESSION['receptiva'] ?></td>
                    </tr>
                    <tr>
                        <td>Expresiva</td>
                        <td><?= $_SESSION['expresiva'] ?></td>
                    </tr>
                    <tr>
                        <td>Comunitario</td>
                        <td><?= $_SESSION['comunitario'] ?></td>

                    </tr>
                    <tr>
                        <td>Juego</td>
                        <td><?= $_SESSION['juego'] ?></td>

                    </tr>
                    <tr>
                        <td>Personal</td>
                        <td><?= $_SESSION['personal'] ?></td>

                    </tr>
                    <tr>
                        <td>Domestico</td>
                        <td><?= $_SESSION['domestico'] ?></td>

                    </tr>
                    <tr>
                        <td>Escritura</td>
                        <td><?= $_SESSION['escritura'] ?></td>

                    </tr>
                    <tr>
                        <td>Habilidades de Afrontamiento</td>
                        <td><?= $_SESSION['afrontamiento'] ?></td>

                    </tr>
                    <tr>
                        <td>Relaciones interpersonales</td>
                        <td><?= $_SESSION['interpersonales'] ?></td>

                    </tr>
                    <tr>
                        <td>Motricidad Gruesa</td>
                        <td><?= $_SESSION['gruesa'] ?></td>

                    </tr>
                    <tr>
                        <td>Fina</td>
                        <td><?= $_SESSION['fina'] ?></td>


                    </tr>
                </tbody>
            </table>
            <?php
            include("../modelo/conexion.php");
            include("../controlador/controlador_ingresar_resultados.php");

            ?>
        </section>

        <section>
            <canvas id="grafico" width="400" height="200"></canvas>
            <script type="text/javascript" src="../vista/inicio/js/grafica.js"></script>
            <!-- fin del contenido principal -->

            <script>
                var canvas = document.getElementById('grafico');
                var ctx = canvas.getContext('2d');

                // Definir los datos para el gráfico
                var data = {
                    labels: ["Receptiva", "Expresiva", "Escritura", "Personal", "Domestico", "Comunitario", "Relaciones Interpersonales", "Juego Y Tiempo Libre", "Habilidades de Afrontamiento", "Gruesa", "Fina"],
                    datasets: [{
                        label: 'Valores v_raw',
                        data: <?php echo json_encode($v_raw_values); ?>,
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
    <script>
        // Captura el gráfico y la tabla como imágenes y genera el PDF con Dompdf
        html2canvas(document.getElementById('grafico')).then(function(chartCanvas) {
            html2canvas(document.getElementById('example')).then(function(tableCanvas) {
                var chartImgData = chartCanvas.toDataURL();
                var tableImgData = tableCanvas.toDataURL();

                // Crea el HTML para el PDF, incluyendo las imágenes capturadas
                var html = '<html><body>';
                html += '<img src="' + chartImgData + '">';
                html += '<br>';
                html += '<img src="' + tableImgData + '">';
                html += '</body></html>';

                // Genera el PDF utilizando Dompdf
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'convert.php', true); // Archivo PHP para generar el PDF con Dompdf
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.responseType = 'blob';

                xhr.onload = function(e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {
                            type: 'application/pdf'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'documento.pdf';
                        link.click();
                    }
                };

                xhr.send('html=' + encodeURIComponent(html));
            });
        });
    </script>
</body>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>