<?php

include_once '../util/connect.php';

$idFormacao = filter_input(INPUT_POST, 'idFormacao', FILTER_VALIDATE_INT);

// validações
$sucesso = false;
$em_uso = false;
$erro_sql = false;

$sql = $mysqli->query("SELECT sendoUsada FROM formacao WHERE id=" . $idFormacao);
while ($row = $sql->fetch_array()) {
    if ($row['sendoUsada'] == 1) {
        $em_uso = true;
    } else {
        if ($mysqli->query("DELETE FROM formacao WHERE id=" . $idFormacao)) {
            $sucesso = true;
        } else {
            $erro_sql = true;
        }
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'em_uso' => $em_uso,
    'erro_sql' => $erro_sql
);

echo json_encode($response_array);
?>