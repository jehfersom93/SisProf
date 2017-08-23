<?php

include_once '../util/connect.php';

$inputNomeFormacao = filter_input(INPUT_POST, 'inputNomeFormacao', FILTER_SANITIZE_STRING);

// validações
$sucesso = false;
$campos = false;
$erro_sql = false;

if (empty($inputNomeFormacao)) {
    $campos = true;
}

if (!$campos) {
    if ($mysqli->query("INSERT INTO formacao (nomeFormacao) VALUES ('$inputNomeFormacao')")) {
        $sucesso = true;
    } else {
        $erro_sql = true;
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'campos' => $campos,
    'erro_sql' => $erro_sql
);

echo json_encode($response_array);
?>