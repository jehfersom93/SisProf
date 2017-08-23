<?php

include_once '../util/connect.php';

$inputNomeInstituicao = filter_input(INPUT_POST, 'inputNomeInstituicao', FILTER_SANITIZE_STRING);

// validações
$sucesso = false;
$existente = false;
$campos = false;
$erro_sql = false;

$res = $mysqli->query("SELECT * FROM instituicao");
while ($row = $res->fetch_array()) {
    if ($inputNomeInstituicao == $row['nomeInstituicao']) {
        $existente = true;
    }
    break;
}

if (empty($inputNomeInstituicao)) {
    $campos = true;
}

if (!$campos && !$existente) {
    if ($mysqli->query("INSERT INTO instituicao (nomeInstituicao) VALUES ('$inputNomeInstituicao')")) {
        $sucesso = true;
    } else {
        $erro_sql = true;
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'existente' => $existente,
    'campos' => $campos,
    'erro_sql' => $erro_sql
);

echo json_encode($response_array);

mysqli_free_result($res);
?>