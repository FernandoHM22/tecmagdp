<?php
if (isset($_FILES['file'])) {
    $limiteColumnas = 8;
    $error = true;
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file, "r");
    $i = 0;
    $skip_row_number = array("1");
    while (($rows = fgetcsv($file_open, 1000, ",")) !== false) {
        $i++;

        if (in_array($row, $skip_row_number)) {
            continue;
        } else {
            if ($i == 2) {
                $columnas = count($rows);
                if ($columnas < $limiteColumnas || $columnas > $limiteColumnas) {
                    echo 1;
                    $error = true;
                } else {
                    $error = false;
                }
            }
            if ($error == false) {
                $no_reloj = $rows[0];
                $nombre = $rows[1];
                $apellidos = $rows[2];
                $formato_fecha_nacimiento = str_replace('/', '-', $rows[3]);
                $fecha_nacimiento = date('Y-m-d', strtotime($formato_fecha_nacimiento));
                $formato_fecha_ingreso = str_replace('/', '-', $rows[4]);
                $fecha_ingreso = date('Y-m-d', strtotime($formato_fecha_ingreso));
                $correo = $rows[5];
                $region = $rows[6];
                $supervisor = $rows[7];
                $array_nuevos[] = array("no_reloj" => $no_reloj, "nombre" => $nombre, "apellidos" => $apellidos, "fecha_nacimiento" => $fecha_nacimiento, "fecha_ingreso" => $fecha_ingreso, "correo" => $correo, "region" => $region, "supervisor" => $supervisor);
            }
        }
    }
    header('Content-type: application/json');
    if ($array_nuevos != '') {
        echo json_encode($array_nuevos);
    }
    fclose($file_open);
} else {
    echo 0;
}
