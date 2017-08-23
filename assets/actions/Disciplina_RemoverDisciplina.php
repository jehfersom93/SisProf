<?php

include_once '../util/connect.php';

$idDisciplina = filter_input(INPUT_POST, 'idDisciplina', FILTER_VALIDATE_INT);

// validações
$sucesso = false;
$em_uso = false;
$erro_sql = false;

$sql = $mysqli->query("SELECT sendoUsada FROM disciplina WHERE id=" . $idDisciplina);
while ($row = $sql->fetch_array()) {
    if ($row['sendoUsada'] == 1) {
        $em_uso = true;
    } else {
        if ($mysqli->query("DELETE FROM disciplina WHERE id=" . $idDisciplina)) {
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