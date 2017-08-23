<?php

include_once '../util/connect.php';

$idProfessor = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$idOpcaoAcesso = filter_input(INPUT_POST, 'idOpcaoAcesso', FILTER_VALIDATE_INT);

// validações
$sucesso_on = false;
$sucesso_off = false;
$erro_sql = false;

if ($res = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessor . " AND idOpcaoAcesso=" . $idOpcaoAcesso)) {
    if ($res->num_rows > 0) {
        if ($mysqli->query("DELETE FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessor . " AND idOpcaoAcesso=" . $idOpcaoAcesso)) {
            $sucesso_off = true;
        } else {
            $erro_sql = true;
            //echo "Erro ao excluir: " . $mysqli->error;
        }
    } else {
        if ($mysqli->query("INSERT INTO professor_opcoes_acesso (idProfessor,idOpcaoAcesso) VALUES(" . $idProfessor . "," . $idOpcaoAcesso . ")")) {
            $sucesso_on = true;
        } else {
            $erro_sql = true;
            //echo "Erro ao inserir: " . $mysqli->error;
        }
    }
} else {
    $erro_sql = true;
}


$response_array = array(
    'sucesso_on' => $sucesso_on,
    'sucesso_off' => $sucesso_off,
    'erro_sql' => $erro_sql
);

echo json_encode($response_array);