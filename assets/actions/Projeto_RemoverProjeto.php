<?php

include_once '../util/connect.php';

$idProjeto = filter_input(INPUT_POST, 'idProjeto', FILTER_VALIDATE_INT);

// validações
$sucesso = false;
$erro_sql = false;

if ($mysqli->query("DELETE FROM professor_projeto WHERE id=" . $idProjeto)) {
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