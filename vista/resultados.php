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


/*
Primero hay una un foreach que se va a meter a la pagina, despues va a haber un foreach que se metera a cada Rango:[

Cuando este ene este rango , se evaluarala el AGE, si cumple entonces se mete a datos, en datos es donde se sacan los valores, 
si no cumple entonces no se mete y sigue corriendo.

*/

$valor = 0;
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


for ($i = 1; $i < 48; $i++) {
    foreach ($data["Pagina " . $i] as $elemento) {
        foreach ($elemento["Rango"] as $rango) {
            if (isset($rango["age"])) {
                // Convertir la edad del item a días
                $edad = explode('-', $rango["age"]);

                $tiempomin = explode(':', $edad[0]);
                $aniosmin = (int)$tiempomin[0];
                $mesesmin = (int)$tiempomin[1];
                $diasmin = (int)$tiempomin[2];
                //Limite inferior del rango de edad en dias
                $minutosmin = ($aniosmin * 365) + ($mesesmin * 30) + $diasmin;

                $tiempomax = explode(':', $edad[1]);
                $aniosmax = (int)$tiempomax[0];
                $mesesmax = (int)$tiempomax[1];
                $diasmax = (int)$tiempomax[2];

                //limite superior del rango en dias
                $minutosmax = ($aniosmax * 365) + ($mesesmax * 30) + $diasmax;
            }
            if ($minutosCronologicos < $minutosmax && $minutosCronologicos >= $minutosmin) {
                echo "entro en Pagina " . $i;
                foreach ($rango["datos"] as $datos) {
                    if (
                        isset($datos['SUBDOMAIN v-Scale Scores']) &&
                        is_numeric($datos['SUBDOMAIN v-Scale Scores'])
                    ) {
                        $valor = $datos['Column14'];
                        if (isset($datos['Column3'])) {
                            $jreceptiva = $datos['Column3'];
                            if (strpos($jreceptiva, '-') !== false) {
                                $jreceptiva = explode('-', $jreceptiva);
                                if (
                                    is_array($jreceptiva) && intval($_SESSION['receptiva']) >= intval($jreceptiva[0])
                                    && intval($_SESSION['receptiva']) < intval($jreceptiva[1])
                                ) {
                                    $v_raw1 = $valor;
                                }
                            } elseif (intval($_SESSION['receptiva']) === intval($jreceptiva)) {
                                $v_raw1 = $valor;
                            }
                        }
                        if (isset($datos['Column4'])) {
                            $jexpresiva = $datos['Column4'];
                            if (strpos($jexpresiva, '-') !== false) {
                                $jexpresiva = explode('-', $jexpresiva);
                                if (
                                    is_array($jexpresiva) && intval($_SESSION['expresiva']) >= intval($jexpresiva[0])
                                    && intval($_SESSION['expresiva']) < intval($jexpresiva[1])
                                ) {
                                    $v_raw2 = $valor;
                                }
                            } elseif (intval($_SESSION['expresiva']) === intval($jexpresiva)) {
                                $v_raw2 = $valor;
                            }
                        }
                        if (isset($datos['Column5'])) {
                            $jescritura = $datos['Column5'];
                            if (strpos($jescritura, '-') !== false) {
                                $jescritura = explode('-', $jescritura);
                                if (
                                    is_array($jescritura) && intval($_SESSION['escritura']) >= intval($jescritura[0])
                                    && intval($_SESSION['escritura']) < intval($jescritura[1])
                                ) {
                                    $v_raw7 = $valor;
                                }
                            } elseif (intval($_SESSION['escritura']) === intval($jescritura)) {
                                $v_raw7 = $valor;
                            }
                        }
                        if (isset($datos['Column6'])) {
                            $jpersonal = $datos['Column6'];
                            if (strpos($jpersonal, '-') !== false) {
                                $jpersonal = explode('-', $jpersonal);
                                if (
                                    is_array($jpersonal) && intval($_SESSION['personal']) >= intval($jpersonal[0])
                                    && intval($_SESSION['personal']) < intval($jpersonal[1])
                                ) {
                                    $v_raw5 = $valor;
                                }
                            } elseif (intval($_SESSION['personal']) === intval($jpersonal)) {
                                $v_raw5 = $valor;
                            }
                        }
                        if (isset($datos['Column7'])) {
                            $jDomestico = $datos['Column7'];
                            if (strpos($jDomestico, '-') !== false) {
                                $jDomestico = explode('-', $jDomestico);
                                if (
                                    is_array($jDomestico) && intval($_SESSION['domestico']) >= intval($jDomestico[0])
                                    && intval($_SESSION['domestico']) < intval($jDomestico[1])
                                ) {
                                    $v_raw6 = $valor;
                                }
                            } elseif (intval($_SESSION['domestico']) === intval($jDomestico)) {
                                $v_raw6 = $valor;
                            }
                        }
                        if (isset($datos['Column8'])) {
                            $jComunitario = $datos['Column8'];
                            if (strpos($jComunitario, '-') !== false) {
                                $jComunitario = explode('-', $jComunitario);
                                if (
                                    is_array($jComunitario) && intval($_SESSION['Comunitario']) >= intval($jComunitario[0])
                                    && intval($_SESSION['Comunitario']) < intval($jComunitario[1])
                                ) {
                                    $v_raw3 = $valor;
                                }
                            } elseif (intval($_SESSION['Comunitario']) === intval($jComunitario)) {
                                $v_raw3 = $valor;
                            }
                        }
                        if (isset($datos['Column9'])) {
                            $jinterpersonal = $datos['Column9'];
                            if (strpos($jinterpersonal, '-') !== false) {
                                $jinterpersonal = explode('-', $jinterpersonal);
                                if (
                                    is_array($jinterpersonal) && intval($_SESSION['interpersonal']) >= intval($jinterpersonal[0])
                                    && intval($_SESSION['interpersonal']) < intval($jinterpersonal[1])
                                ) {
                                    $v_raw9 = $valor;
                                }
                            } elseif (intval($_SESSION['interpersonal']) === intval($jinterpersonal)) {
                                $v_raw9 = $valor;
                            }
                        }
                        if (isset($datos['Column10'])) {
                            $jgame = $datos['Column10'];
                            if (strpos($jgame, '-') !== false) {
                                $jgame = explode('-', $jgame);
                                if (
                                    is_array($jgame) && intval($_SESSION['juego']) >= intval($jgame[0])
                                    && intval($_SESSION['juego']) < intval($jgame[1])
                                ) {
                                    $v_raw4 = $valor;
                                }
                            } elseif (intval($_SESSION['juego']) === intval($jgame)) {
                                $v_raw4 = $valor;
                            }
                        }
                        if (isset($datos['Column11'])) {
                            $jafrontamiento = $datos['Column11'];
                            if (strpos($jafrontamiento, '-') !== false) {
                                $jafrontamiento = explode('-', $jafrontamiento);
                                if (
                                    is_array($jafrontamiento) && intval($_SESSION['afrontamiento']) >= intval($jafrontamiento[0])
                                    && intval($_SESSION['afrontamiento']) < intval($jafrontamiento[1])
                                ) {
                                    $v_raw8 = $valor;
                                }
                            } elseif (intval($_SESSION['afrontamiento']) === intval($jafrontamiento)) {
                                $v_raw8 = $valor;
                            }
                        }
                        if (isset($datos['Column12'])) {
                            $jgruesa = $datos['Column12'];
                            if (strpos($jgruesa, '-') !== false) {
                                $jgruesa = explode('-', $jgruesa);
                                if (
                                    is_array($jgruesa) && intval($_SESSION['gruesa']) >= intval($jgruesa[0])
                                    && intval($_SESSION['gruesa']) < intval($jgruesa[1])
                                ) {
                                    $v_raw10 = $valor;
                                }
                            } elseif (intval($_SESSION['gruesa']) === intval($jgruesa)) {
                                $v_raw10 = $valor;
                            }
                            // aqui lo que pasa es que estoy mirando cando es una array
                        }
                        if (isset($datos['Column13'])) {
                            $jfina = $datos['Column13'];
                            if (strpos($jfina, '-') !== false) {
                                $jfina = explode('-', $jfina);
                                if (
                                    is_array($jfina) && intval($_SESSION['fina']) >= intval($jfina[0])
                                    && intval($_SESSION['fina']) < intval($jfina[1])
                                ) {
                                    $v_raw11 = $valor;
                                }
                            } elseif (intval($_SESSION['fina']) === intval($jfina)) {
                                $v_raw11 = $valor;
                            }
                        }
                    } elseif (isset($datos['Column1']) && is_numeric($datos['Column1'])) {

                        $valor = $datos['Column1'];

                        if (isset($datos['Column2'])) {
                            $jreceptiva = $datos['Column2'];
                            if (strpos($jreceptiva, '-') !== false) {
                                $jreceptiva = explode('-', $jreceptiva);
                                if (
                                    is_array($jreceptiva) && intval($_SESSION['receptiva']) >= intval($jreceptiva[0])
                                    && intval($_SESSION['receptiva']) < intval($jreceptiva[1])
                                ) {
                                    $v_raw1 = $valor;
                                }
                            } elseif ($_SESSION['receptiva'] == $jreceptiva) {
                                $v_raw1 = $valor;
                            }
                        }
                        if (isset($datos['Column3'])) {
                            $jexpresiva = $datos['Column3'];
                            if (strpos($jexpresiva, '-') !== false) {
                                $jexpresiva = explode('-', $jexpresiva);
                                if (
                                    is_array($jexpresiva) && intval($_SESSION['expresiva']) >= intval($jexpresiva[0])
                                    && intval($_SESSION['expresiva']) < intval($jexpresiva[1])
                                ) {
                                    $v_raw2 = $valor;
                                }
                            } elseif ($_SESSION['expresiva'] === $jexpresiva) {
                                $v_raw2 = $valor;
                            }
                        }
                        if (isset($datos['Column4'])) {
                            $jescritura = $datos['Column4'];
                            if (strpos($jescritura, '-') !== false) {
                                $jescritura = explode('-', $jescritura);
                                if (
                                    is_array($jescritura) && intval($_SESSION['escritura']) >= intval($jescritura[0])
                                    && intval($_SESSION['escritura']) < intval($jescritura[1])
                                ) {
                                    $v_raw7 = $valor;
                                }
                            } elseif ($_SESSION['escritura'] === $jescritura) {
                                $v_raw7 = $valor;
                            }
                        }
                        if (isset($datos['Column5'])) {
                            $jpersonal = $datos['Column5'];
                            if (strpos($jpersonal, '-') !== false) {
                                $jpersonal = explode('-', $jpersonal);
                                if (
                                    is_array($jpersonal) && intval($_SESSION['personal']) >= intval($jpersonal[0])
                                    && intval($_SESSION['personal']) < intval($jpersonal[1])
                                ) {
                                    $v_raw5 = $valor;
                                }
                            } elseif ($_SESSION['personal'] === $jpersonal) {
                                $v_raw5 = $valor;
                            }
                        }
                        if (isset($datos['Column6'])) {
                            $jDomestico = $datos['Column6'];
                            if (strpos($jDomestico, '-') !== false) {
                                $jDomestico = explode('-', $jDomestico);
                                if (
                                    is_array($jDomestico) && intval($_SESSION['domestico']) >= intval($jDomestico[0])
                                    && intval($_SESSION['domestico']) < intval($jDomestico[1])
                                ) {
                                    $v_raw6 = $valor;
                                }
                            } elseif ($_SESSION['domestico'] === $jDomestico) {
                                $v_raw6 = $valor;
                            }
                        }
                        if (isset($datos['Column7'])) {
                            $jComunitario = $datos['Column7'];
                            if (strpos($jComunitario, '-') !== false) {
                                $jComunitario = explode('-', $jComunitario);
                                if (
                                    is_array($jComunitario) && intval($_SESSION['comunitario']) >= intval($jComunitario[0])
                                    && intval($_SESSION['comunitario']) < intval($jComunitario[1])
                                ) {
                                    $v_raw3 = $valor;
                                }
                            } elseif ($_SESSION['comunitario'] === $jComunitario) {
                                $v_raw3 = $valor;
                            }
                        }
                        if (isset($datos['Column8'])) {
                            $jinterpersonal = $datos['Column8'];
                            if (strpos($jinterpersonal, '-') !== false) {
                                $jinterpersonal = explode('-', $jinterpersonal);
                                if (
                                    is_array($jinterpersonal) && intval($_SESSION['interpersonales']) >= intval($jinterpersonal[0])
                                    && intval($_SESSION['interpersonales']) < intval($jinterpersonal[1])
                                ) {
                                    $v_raw9 = $valor;
                                }
                            } elseif ($_SESSION['interpersonales'] === $jinterpersonal) {
                                $v_raw9 = $valor;
                            }
                        }
                        if (isset($datos['Column9'])) {
                            $jgame = $datos['Column9'];
                            if (strpos($jgame, '-') !== false) {
                                $jgame = explode('-', $jgame);
                                if (
                                    is_array($jgame) && intval($_SESSION['juego']) >= intval($jgame[0])
                                    && intval($_SESSION['juego']) < intval($jgame[1])
                                ) {
                                    $v_raw4 = $valor;
                                }
                            } elseif ($_SESSION['juego'] === $jgame) {
                                $v_raw4 = $valor;
                            }
                        }
                        if (isset($datos['Column10'])) {
                            $jafrontamiento = $datos['Column10'];
                            if (strpos($jafrontamiento, '-') !== false) {
                                $jafrontamiento = explode('-', $jafrontamiento);
                                if (
                                    is_array($jafrontamiento) && intval($_SESSION['afrontamiento']) >= intval($jafrontamiento[0])
                                    && intval($_SESSION['afrontamiento']) < intval($jafrontamiento[1])
                                ) {
                                    $v_raw8 = $valor;
                                }
                            } elseif ($_SESSION['afrontamiento'] === $jafrontamiento) {
                                $v_raw8 = $valor;
                            }
                        }
                        if (isset($datos['Column11'])) {
                            $jgruesa = $datos['Column11'];
                            if (strpos($jgruesa, '-') !== false) {
                                $jgruesa = explode('-', $jgruesa);
                                if (
                                    is_array($jgruesa) && intval($_SESSION['gruesa']) >= intval($jgruesa[0])
                                    && intval($_SESSION['gruesa']) < intval($jgruesa[1])
                                ) {
                                    $v_raw10 = $valor;
                                }
                            } elseif ($_SESSION['gruesa'] === $jgruesa) {
                                $v_raw10 = $valor;
                            }
                        }
                        if (isset($datos['Column12'])) {
                            $jfina = $datos['Column12'];
                            if (strpos($jfina, '-') !== false) {
                                $jfina = explode('-', $jfina);
                                if (
                                    is_array($jfina) && intval($_SESSION['fina']) >= intval($jfina[0])
                                    && intval($_SESSION['fina']) < intval($jfina[1])
                                ) {
                                    $v_raw11 = $valor;
                                }
                            } elseif (intval($_SESSION['fina']) === intval($jfina)) {
                                $v_raw11 = $valor;
                            }
                        }
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
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th scope="col">Subdominio</th>
                        <th scope="col">Raw Score</th>
                        <th scope="col">V-raw Score</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
            <?php
            include("../modelo/conexion.php");

            //include("../controlador/controlador_ingresar_resultados.php");

            ?>
        </section>
        <canvas id="myChart" width="400" height="200"></canvas>

    </div>

    <!-- fin del contenido principal -->

</body>

<script src="../vista/inicio/js/grafica.js"></script>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>