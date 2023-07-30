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
            <h2>Tabla 1</h2>
            <h3 id="subdominio">Raw Score por Dominios</h3>
            <table class="table table-striped table-hover" id="">
                <thead>
                    <tr>
                        <th scope="col">Dominio</th>
                        <th scope="col">Raw Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Comunicacion</td>
                        <td><?= intval($_SESSION['receptiva']) + intval($_SESSION['expresiva']) + intval($_SESSION['escritura']) ?></td>
                    </tr>
                    <tr>
                        <td>Habilidades de la Vida Diaria</td>
                        <td><?= intval($_SESSION['comunitario']) + intval($_SESSION['domestico']) + intval($_SESSION['personal']) ?></td>
                    </tr>
                    <tr>
                        <td>Socializacion</td>
                        <td><?= intval($_SESSION['interpersonales']) + intval($_SESSION['juego']) + intval($_SESSION['afrontamiento']) ?></td>

                    </tr>
                    <tr>
                        <td>Habilidades Motoras</td>
                        <td><?= intval($_SESSION['gruesa']) + intval($_SESSION['fina']) ?></td>

                    </tr>
                </tbody>
            </table>
        </section>
        <p></p>
        <p></p>
        <section>
            <h2>Tabla 2</h2>
            <h3 id="subdominio">Raw Score por Subdominios</h3>
            <table class="table table-striped table-hover" id="">
                <thead>
                    <tr>
                        <th scope="col">Subdominio</th>
                        <th scope="col">Raw Score</th>
                        <th scope="col">V-Raw Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Receptiva</td>
                        <td><?= $_SESSION['receptiva'] ?></td>
                        <td><?php echo $v_raw_values[0] ?></td>
                    </tr>
                    <tr>
                        <td>Expresiva</td>
                        <td><?= $_SESSION['expresiva'] ?></td>
                        <td><?php echo $v_raw_values[1] ?></td>
                    </tr>
                    <tr>
                        <td>Escritura</td>
                        <td><?= $_SESSION['escritura'] ?></td>
                        <td><?php echo $v_raw_values[2] ?></td>
                    </tr>
                    <tr>
                        <td>Personal</td>
                        <td><?= $_SESSION['personal'] ?></td>
                        <td><?php echo $v_raw_values[3] ?></td>
                    </tr>
                    <tr>
                        <td>Domestico</td>
                        <td><?= $_SESSION['domestico'] ?></td>
                        <td><?php echo $v_raw_values[4] ?></td>
                    </tr>
                    <tr>
                        <td>Comunitario</td>
                        <td><?= $_SESSION['comunitario'] ?></td>
                        <td><?php echo $v_raw_values[5] ?></td>
                    </tr>
                    <tr>
                        <td>Relaciones interpersonales</td>
                        <td><?= $_SESSION['interpersonales'] ?></td>
                        <td><?php echo $v_raw_values[6] ?></td>
                    </tr>
                    <tr>
                        <td>Juego</td>
                        <td><?= $_SESSION['juego'] ?></td>
                        <td><?php echo $v_raw_values[7] ?></td>
                    </tr>
                    <tr>
                        <td>Habilidades de Afrontamiento</td>
                        <td><?= $_SESSION['afrontamiento'] ?></td>
                        <td><?php echo $v_raw_values[8] ?></td>
                    </tr>

                    <tr>
                        <td>Motricidad Gruesa</td>
                        <td><?= $_SESSION['gruesa'] ?></td>
                        <td><?php echo $v_raw_values[9] ?></td>
                    </tr>
                    <tr>
                        <td>Fina</td>
                        <td><?= $_SESSION['fina'] ?></td>
                        <td><?php echo $v_raw_values[10] ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            include("../modelo/conexion.php");
            include("../controlador/controlador_ingresar_resultados.php");

            ?>
        </section>
        <p></p>
        <p></p>
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
        <section>
            <button class="sumbit" method="POST" action="receptiva.php" >
                <span class="btnText">Terminar Evaluacion</span>
                <i class="uil uil-navigator"></i>
            </button>
        </section>
    </div>
</body>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>