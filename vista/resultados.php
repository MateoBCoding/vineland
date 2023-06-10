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

$valor;
$v_raw1 = 0;
$v_raw2 = 0;
$v_raw3 = 0;
$v_raw4 = 0;
$v_raw5 = 0;
$v_raw6 = 0;
$v_raw7 = 0;
$v_raw8 = 0;
$v_raw9 = 0;
$v_raw10 = 0;
$v_raw11 = 0;

$numero = 1;

$encontradaOtraAge = false;
// Obtener el contenido del archivo JSON
$jsonData = file_get_contents('../vista/Vinelantblas.json');

// Decodificar el JSON a un arreglo asociativo
$data = json_decode($jsonData, true);

// Edad cronológica a comparar en formato "años meses días"
$edadCronologica = $_SESSION['edad'];

// Convertir la edad cronológica a días
$tiempo = explode(':', $edadCronologica);
$anios = (int)$tiempo[0];
$meses = (int)$tiempo[1];
$dias = (int)$tiempo[2];

//Dias totales
$minutosCronologicos = ($anios * 365) + ($meses * 30) + $dias;

// Buscar la variable "age" en el arreglo y validar la edad cronológica
$age = '';

foreach ($data['Pagina ' . $numero] as $item) {
    $numero = $numero + 1;
    if (isset($item['age'])) {

        if ($age !== '' && $encontradaOtraAge) {
            break;
        }

        // Convertir la edad del item a días
        $rango = explode('-', $item['age']);

        $tiempomin = explode(':', $rango[0]);
        $aniosmin = (int)$tiempomin[0];
        $mesesmin = (int)$tiempomin[1];
        $diasmin = (int)$tiempomin[2];

        //Limite inferior del rango de edad en dias
        $minutosmin = ($aniosmin * 365) + ($mesesmin * 30) + $diasmin;

        $tiempomax = explode(':', $rango[1]);
        $aniosmax = (int)$tiempomax[0];
        $mesesmax = (int)$tiempomax[1];
        $diasmax = (int)$tiempomax[2];

        //limite superior del rango en dias
        $minutosmax = ($aniosmax * 365) + ($mesesmax * 30) + $diasmax;

        if ($minutosCronologicos < $minutosmax && $minutosCronologicos >= $minutosmin) {
            $age = $item['age'];

            // Marcar que se encontró otra variable "age"
            $encontradaOtraAge = true;
        }
    }
    if (isset($item['datos'])) {
        foreach ($item['datos'] as $key => $value) {

            if (is_numeric($value) && $key === "Column14") {
                $valor = $value;
                $jreceptiva = $value['Column3'];
                $jexpresiva = $value['Column4'];
                $jescritura = $value['Column5'];
                $jDomestico = $value['Column6'];
                $jafrontamiento = $value['Column7'];
                $jgame = $value['Column8'];
                $jfina = $value['Column9'];
                $jgruesa = $value['Column10'];
                $jComunitario = $value['Column11'];
                $jpersonal = $value['Column12'];
                $jinterpersonal = $value['Column13'];

                if (strpos($jreceptiva, '-') !== false) {
                    $jreceptiva = explode('-', $jreceptiva);
                }
                if (strpos($jexpresiva, '-') !== false) {
                    $jexpresiva = explode('-', $jexpresiva);
                }
                if (strpos($jescritura, '-') !== false) {
                    $jescritura = explode('-', $jescritura);
                }
                if (strpos($jDomestico, '-') !== false) {
                    $jDomestico = explode('-', $jDomestico);
                }
                if (strpos($jafrontamiento, '-') !== false) {
                    $jafrontamiento = explode('-', $jafrontamiento);
                }
                if (strpos($jgame, '-') !== false) {
                    $jgame = explode('-', $jgame);
                }
                if (strpos($jfina, '-') !== false) {
                    $jfina = explode('-', $jfina);
                }
                if (strpos($jgruesa, '-') !== false) {
                    $jgruesa = explode('-', $jgruesa);
                }
                if (strpos($jComunitario, '-') !== false) {
                    $jComunitario = explode('-', $jComunitario);
                }
                if (strpos($jpersonal, '-') !== false) {
                    $jpersonal = explode('-', $jpersonal);
                }
                if (strpos($jinterpersonal, '-') !== false) {
                    $jinterpersonal = explode('-', $jinterpersonal);
                }


                if (
                    is_array($jreceptiva) && intval($_SESSION['receptiva']) >= intval($jreceptiva[0])
                    && intval($_SESSION['receptiva']) <= intval($jreceptiva[1])
                ) {
                    $v_raw1 = $value["Column14"];
                } elseif (intval($_SESSION['receptiva']) === intval($jreceptiva[0])) {
                    $v_raw1 = $value["Column14"];
                }

                if (
                    is_array($jexpresiva) && intval($_SESSION['expresiva']) >= intval($jexpresiva[0])
                    && intval($_SESSION['expresiva']) <= intval($jexpresiva[1])
                ) {
                    $v_raw2 = $value["Column14"];
                } elseif (intval($_SESSION['expresiva']) === intval($jexpresiva[0])) {
                    $v_raw2 = $value["Column14"];
                }

                if (
                    is_array($jescritura) && intval($_SESSION['escritura']) >= intval($jescritura[0])
                    && intval($_SESSION['escritura']) <= intval($jescritura[1])
                ) {
                    $v_raw3 = $value["Column14"];
                } elseif (intval($_SESSION['escritura']) === intval($jescritura[0])) {
                    $v_raw3 = $value["Column14"];
                }

                if (
                    is_array($jDomestico) && intval($_SESSION['Domestico']) >= intval($jDomestico[0])
                    && intval($_SESSION['Domestico']) <= intval($jDomestico[1])
                ) {
                    $v_raw4 = $value["Column14"];
                } elseif (intval($_SESSION['Domestico']) === intval($jDomestico[0])) {
                    $v_raw4 = $value["Column14"];
                }

                if (
                    is_array($jafrontamiento) && intval($_SESSION['afrontamiento']) >= intval($jafrontamiento[0])
                    && intval($_SESSION['afrontamiento']) <= intval($jafrontamiento[1])
                ) {
                    $v_raw5 = $value["Column14"];
                } elseif (intval($_SESSION['afrontamiento']) === intval($jafrontamiento[0])) {
                    $v_raw5 = $value["Column14"];
                }

                if (
                    is_array($jgame) && intval($_SESSION['juego']) >= intval($jgame[0])
                    && intval($_SESSION['juego']) <= intval($jgame[1])
                ) {
                    $v_raw6 = $value["Column14"];
                } elseif (intval($_SESSION['juego']) === intval($jgame[0])) {
                    $v_raw6 = $value["Column14"];
                }

                if (
                    is_array($jfina) && intval($_SESSION['fina']) >= intval($jfina[0])
                    && intval($_SESSION['fina']) <= intval($jfina[1])
                ) {
                    $v_raw7 = $value["Column14"];
                } elseif (intval($_SESSION['fina']) === intval($jfina[0])) {
                    $v_raw7 = $value["Column14"];
                }

                if (
                    is_array($jgruesa) && intval($_SESSION['gruesa']) >= intval($jgruesa[0])
                    && intval($_SESSION['gruesa']) <= intval($jgruesa[1])
                ) {
                    $v_raw8 = $value["Column14"];
                } elseif (intval($_SESSION['gruesa']) === intval($jgruesa[0])) {
                    $v_raw8 = $value["Column14"];
                }

                if (
                    is_array($jComunitario) && intval($_SESSION['Comunitario']) >= intval($jComunitario[0])
                    && intval($_SESSION['Comunitario']) <= intval($jComunitario[1])
                ) {
                    $v_raw9 = $value["Column14"];
                } elseif (intval($_SESSION['Comunitario']) === intval($jComunitario[0])) {
                    $v_raw9 = $value["Column14"];
                }

                if (
                    is_array($jpersonal) && intval($_SESSION['personal']) >= intval($jpersonal[0])
                    && intval($_SESSION['personal']) <= intval($jpersonal[1])
                ) {
                    $v_raw10 = $value["Column14"];
                } elseif (intval($_SESSION['personal']) === intval($jpersonal[0])) {
                    $v_raw10 = $value["Column14"];
                }

                if (
                    is_array($jinterpersonal) && intval($_SESSION['interpersonal']) >= intval($jinterpersonal[0])
                    && intval($_SESSION['interpersonal']) <= intval($jinterpersonal[1])
                ) {
                    $v_raw11 = $value["Column14"];
                } elseif (intval($_SESSION['interpersonal']) === intval($jinterpersonal[0])) {
                    $v_raw11 = $value["Column14"];
                }
            }
//
//
//
//
            if (is_numeric($value) && $key == "Column13") {
                if (!isset($valor)) {
                    $valor = $value;
                }
                if ($key == "Column2") {
                    $jreceptiva = $value;
                    if (strpos($jreceptiva, '-') !== false) {
                        $jreceptiva = explode('-', $jreceptiva);
                    }
                    if (
                        is_array($jreceptiva) && intval($_SESSION['receptiva']) >= intval($jreceptiva[0])
                        && intval($_SESSION['receptiva']) <= intval($jreceptiva[1])
                    ) {
                        $v_raw1 = $valor;
                    } elseif (intval($_SESSION['receptiva']) === intval($jreceptiva)) {
                        $v_raw1 = $valor;
                    }
                }
                if ($key == "Column3") {
                    $jexpresiva = $value;
                    if (strpos($jexpresiva, '-') !== false) {
                        $jexpresiva = explode('-', $jexpresiva);
                    }
                    if (
                        is_array($jexpresiva) && intval($_SESSION['expresiva']) >= intval($jexpresiva[0])
                        && intval($_SESSION['expresiva']) <= intval($jexpresiva[1])
                    ) {
                        $v_raw2 = $valor;
                    } elseif (intval($_SESSION['expresiva']) === intval($jexpresiva)) {
                        $v_raw2 = $valor;
                    }
                }
                if ($key == "Column4") {
                    $jescritura = $value;
                    if (strpos($jescritura, '-') !== false) {
                        $jescritura = explode('-', $jescritura);
                    }
                    if (
                        is_array($jescritura) && intval($_SESSION['escritura']) >= intval($jescritura[0])
                        && intval($_SESSION['escritura']) <= intval($jescritura[1])
                    ) {
                        $v_raw3 = $valor;
                    } elseif (intval($_SESSION['escritura']) === intval($jescritura)) {
                        $v_raw3 = $valor;
                    }
                }
                if ($key == "Column5") {
                    $jpersonal = $value;
                    if (strpos($jpersonal, '-') !== false) {
                        $jpersonal = explode('-', $jpersonal);
                    }
                    if (
                        is_array($jpersonal) && intval($_SESSION['personal']) >= intval($jpersonal[0])
                        && intval($_SESSION['personal']) <= intval($jpersonal[1])
                    ) {
                        $v_raw10 = $valor;
                    } elseif (intval($_SESSION['personal']) === intval($jpersonal[0])) {
                        $v_raw10 = $valor;
                    }
                }
                if ($key == "Column6") {
                    $jDomestico = $value;
                    if (strpos($jDomestico, '-') !== false) {
                        $jDomestico = explode('-', $jDomestico);
                    }
                    if (
                        is_array($jDomestico) && intval($_SESSION['domestico']) >= intval($jDomestico[0])
                        && intval($_SESSION['domestico']) <= intval($jDomestico[1])
                    ) {
                        $v_raw4 = $valor;
                    } elseif (intval($_SESSION['domestico']) === intval($jDomestico[0])) {
                        $v_raw4 = $valor;
                    }
                }
                if ($key == "Column7") {
                    $jComunitario = $value;
                    if (strpos($jComunitario, '-') !== false) {
                        $jComunitario = explode('-', $jComunitario);
                    }
                    if (
                        is_array($jComunitario) && intval($_SESSION['Comunitario']) >= intval($jComunitario[0])
                        && intval($_SESSION['Comunitario']) <= intval($jComunitario[1])
                    ) {
                        $v_raw9 = $valor;
                    } elseif (intval($_SESSION['Comunitario']) === intval($jComunitario[0])) {
                        $v_raw9 = $valor;
                    }
                }
                if ($key == "Column8") {
                    $jinterpersonal = $value;
                    if (strpos($jinterpersonal, '-') !== false) {
                        $jinterpersonal = explode('-', $jinterpersonal);
                    }
                    if (
                        is_array($jinterpersonal) && intval($_SESSION['interpersonal']) >= intval($jinterpersonal[0])
                        && intval($_SESSION['interpersonal']) <= intval($jinterpersonal[1])
                    ) {
                        $v_raw11 = $valor;
                    } elseif (intval($_SESSION['interpersonal']) === intval($jinterpersonal[0])) {
                        $v_raw11 = $valor;
                    }
                }
                if ($key == "Column9") {
                    $jgame = $value;
                    if (strpos($jgame, '-') !== false) {
                        $jgame = explode('-', $jgame);
                    }
                    if (
                        is_array($jgame) && intval($_SESSION['juego']) >= intval($jgame[0])
                        && intval($_SESSION['juego']) <= intval($jgame[1])
                    ) {
                        $v_raw6 = $valor;
                    } elseif (intval($_SESSION['juego']) === intval($jgame[0])) {
                        $v_raw6 = $valor;
                    }
                }
                if ($key == "Column10") {
                    $jafrontamiento = $value;
                    if (strpos($jafrontamiento, '-') !== false) {
                        $jafrontamiento = explode('-', $jafrontamiento);
                    }
                    if (
                        is_array($jafrontamiento) && intval($_SESSION['afrontamiento']) >= intval($jafrontamiento[0])
                        && intval($_SESSION['afrontamiento']) <= intval($jafrontamiento[1])
                    ) {
                        $v_raw5 = $valor;
                    } elseif (intval($_SESSION['afrontamiento']) === intval($jafrontamiento[0])) {
                        $v_raw5 = $valor;
                    }
                }
                if ($key == "Column11") {
                    $jgruesa = $value;
                    if (strpos($jgruesa, '-') !== false) {
                        $jgruesa = explode('-', $jgruesa);
                    }
                    if (
                        is_array($jgruesa) && intval($_SESSION['gruesa']) >= intval($jgruesa[0])
                        && intval($_SESSION['gruesa']) <= intval($jgruesa[1])
                    ) {
                        $v_raw8 = $valor;
                    } elseif (intval($_SESSION['gruesa']) === intval($jgruesa[0])) {
                        $v_raw8 = $valor;
                    }
                }
                if ($key == "Column12") {
                    $jfina = $value;
                    if (strpos($jfina, '-') !== false) {
                        $jfina = explode('-', $jfina);
                    }
                    if (
                        is_array($jfina) && intval($_SESSION['fina']) >= intval($jfina[0])
                        && intval($_SESSION['fina']) <= intval($jfina[1])
                    ) {
                        $v_raw7 = $valor;
                    } elseif (intval($_SESSION['fina']) === intval($jfina[0])) {
                        $v_raw7 = $valor;
                    }
                }
            }
        }
    }
}
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.js" integrity="sha512-Cv3WnEz5uGwmTnA48999hgbYV1ImGjsDWyYQakowKw+skDXEYYSU+rlm9tTflyXc8DbbKamcLFF80Cf89f+vOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            <table>
                <tr>
                    <th>Subdominio</th>
                    <th>Raw Score</th>
                    <th>V-raw Score</th>
                </tr>
                <tr>
                    <td>Receptiva</td>
                    <td><?= $_SESSION['receptiva'] ?></td>
                    <td><?= $v_raw1 ?></td>
                </tr>
                <tr>
                    <td>Expresiva</td>
                    <td><?= $_SESSION['expresiva'] ?></td>
                    <td><?= $v_raw2 ?></td>
                </tr>
                <tr>
                    <td>Comunitario</td>
                    <td><?= $_SESSION['comunitario'] ?></td>
                    <td><?= $v_raw3 ?></td>
                </tr>
                <tr>
                    <td>Juego</td>
                    <td><?= $_SESSION['juego'] ?></td>
                    <td><?= $v_raw4 ?></td>
                </tr>
                <tr>
                    <td>Personal</td>
                    <td><?= $_SESSION['personal'] ?></td>
                    <td><?= $v_raw5 ?></td>
                </tr>
                <tr>
                    <td>Domestico</td>
                    <td><?= $_SESSION['domestico'] ?></td>
                    <td><?= $v_raw6 ?></td>
                </tr>
                <tr>
                    <td>Escritura</td>
                    <td><?= $_SESSION['escritura'] ?></td>
                    <td><?= $v_raw7 ?></td>
                </tr>
                <tr>
                    <td>Habilidades de Afrontamiento</td>
                    <td><?= $_SESSION['afrontamiento'] ?></td>
                    <td><?= $v_raw8 ?></td>
                </tr>
                <tr>
                    <td>Relaciones interpersonales</td>
                    <td><?= $_SESSION['interpersonales'] ?></td>
                    <td><?= $v_raw9 ?></td>
                </tr>
                <tr>
                    <td>Motricidad Gruesa</td>
                    <td><?= $_SESSION['gruesa'] ?></td>
                    <td><?= $v_raw10 ?></td>
                </tr>
                <tr>
                    <td>Fina</td>
                    <td><?= $_SESSION['fina'] ?></td>
                    <td><?= $v_raw11 ?></td>

                </tr>
            </table>
            <?php
            echo $_SESSION['edad'];
            echo "|";
            echo $valor;

            include("../modelo/conexion.php");

            //include("../controlador/controlador_ingresar_resultados.php");

            ?>
        </section>


        <canvas id="myChart" width="600" height="400"></canvas>
    </div>

    <!-- fin del contenido principal -->

</body>

<script src="../vista/inicio/js/grafica.js"></script>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>