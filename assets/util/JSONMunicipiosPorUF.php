<?php

include 'connect.php';

$uf = filter_input(INPUT_GET, 'uf', FILTER_SANITIZE_STRING);

$municipios = $mysqli->query("SELECT nome FROM municipio WHERE uf='" . $uf . "'");

$i = 0;
while ($row = $municipios->fetch_array()) {
    $municipiosArray[$i] = array(
        'nome' => $row["nome"]
    );
    $i++;
}

$json = json_encode($municipiosArray);

if ($json)
    echo $json;
else
    echo json_last_error_msg();