<?php

if (isset($_SESSION['receptiva'])) {
    $identrevistado = $_SESSION['identrevistado'];
    $idusuario = $_SESSION['id_usuario'];
    $receptiva = $_SESSION['receptiva'];
    $expresiva = $_SESSION['expresiva'];
    $comunitario = $_SESSION['comunitario'];
    $juego = $_SESSION['juego'];
    $personal = $_SESSION['personal'];
    $domestico = $_SESSION['domestico'];
    $escritura = $_SESSION['escritura'];
    $afrontamiento = $_SESSION['afrontamiento'];
    $interpersonales = $_SESSION['interpersonales'];
    $gruesa = $_SESSION['gruesa'];
    $fina = $_SESSION['fina'];
    $vraw1 = $v_raw_values[0];
    $vraw2 = $v_raw_values[1];
    $vraw3 = $v_raw_values[2];
    $vraw4 = $v_raw_values[3];
    $vraw5 = $v_raw_values[4];
    $vraw6 = $v_raw_values[5];
    $vraw7 = $v_raw_values[6];
    $vraw8 = $v_raw_values[7];
    $vraw9 = $v_raw_values[8];
    $vraw10 = $v_raw_values[9];
    $vraw11 = $v_raw_values[10];

    $sql = $conexion->query("INSERT INTO resultados (identrevistado, idusuario, Receptiva, Expresiva,
        Escritura, Personal, Domestico, Comunitario, Relaciones_Interpersonales, Juego_y_tiempo_libre,
        Habilidades_afrontamiento, Motricidad_Gruesa, Motricidad_Fina,
        Vraw_1, Vraw_2, Vraw_3, Vraw_4, Vraw_5, Vraw_6, Vraw_7, Vraw_8, Vraw_9,
        Vraw_10, Vraw_11)
        VALUES
        ($identrevistado, $idusuario,$receptiva,$expresiva, $escritura, $personal, $domestico, $comunitario,
        $interpersonales, $juego, $afrontamiento, $gruesa, $fina, $vraw1, $vraw2, $vraw3, $vraw4, $vraw5, $vraw6,
        $vraw7, $vraw8, $vraw9, $vraw10, $vraw11);");
}
