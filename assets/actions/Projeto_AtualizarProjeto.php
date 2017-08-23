<?php

include_once '../util/connect.php';

$idProjeto = filter_input(INPUT_POST, 'idProjeto', FILTER_VALIDATE_INT);
$inputTituloProjeto = filter_input(INPUT_POST, 'inputTituloProjeto', FILTER_SANITIZE_STRING);
$textareaDescricaoProjeto = filter_input(INPUT_POST, 'textareaDescricaoProjeto', FILTER_SANITIZE_STRING);

// validações
$sucesso = false;
$campos = false;
$erro_sql = false;

if (empty($inputTituloProjeto) || empty($textareaDescricaoProjeto)) {
    $campos = true;
}

if (!$campos) {
    if ($mysqli->query("UPDATE professor_projeto SET tituloProjeto='$inputTituloProjeto',descricaoProjeto='$textareaDescricaoProjeto' WHERE id=" . $idProjeto)) {
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