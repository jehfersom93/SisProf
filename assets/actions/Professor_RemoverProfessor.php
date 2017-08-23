<?php

include_once '../util/connect.php';

$idProfessor = filter_input(INPUT_POST, 'idProfessor', FILTER_VALIDATE_INT);

// validações
$sucesso = false;
$erro_sql = false;

// sqls
$sql1 = false;
$sql2 = false;
$sql3 = false;
$sql4 = false;
$sql5 = false;
$sql6 = false;

if ($mysqli->query("DELETE FROM professor WHERE id=" . $idProfessor)) {
    $sql1 = true;
    if ($mysqli->query("DELETE FROM professor_disciplina WHERE idProfessor=" . $idProfessor)) {
        $sql2 = true;
        if ($mysqli->query("DELETE FROM professor_formacao WHERE idProfessor=" . $idProfessor)) {
            $sql3 = true;
            if ($mysqli->query("DELETE FROM professor_instituicao WHERE idProfessor=" . $idProfessor)) {
                $sql4 = true;
                if ($mysqli->query("DELETE FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessor)) {
                    $sql5 = true;
                    if ($mysqli->query("DELETE FROM professor_projeto WHERE idProfessor=" . $idProfessor)) {
                        $sql6 = true;
                    }
                }
            }
        }
    }
}

if ($sql1 && $sql2 && $sql3 && $sql4 && $sql5 && $sql6) {
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