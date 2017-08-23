<?php

include_once '../util/connect.php';

$idInstituicao = filter_input(INPUT_POST, 'idInstituicao', FILTER_VALIDATE_INT);

// validações
$sucesso = false;
$erro_sql = false;

if ($mysqli->query("DELETE FROM instituicao WHERE id=" . $idInstituicao)) {
    $sucesso = true;
} else {
    $erro_sql = true;
}

$response_array = array(
    'sucesso' => $sucesso,
    'erro_sql' => $erro_sql
);

echo json_encode($response_array);
?>