<?php

include_once '../util/connect.php';

$inputNomeDisciplina = filter_input(INPUT_POST, 'inputNomeDisciplina', FILTER_SANITIZE_STRING);
$textareaDescricaoDisciplina = filter_input(INPUT_POST, 'textareaDescricaoDisciplina', FILTER_SANITIZE_STRING);
$inputTagsDisciplina = filter_input(INPUT_POST, 'inputTagsDisciplina', FILTER_SANITIZE_STRING);
$inputUrlThumbDisciplina = filter_input(INPUT_POST, 'inputUrlThumbDisciplina', FILTER_SANITIZE_URL);
$inputUrlFotoDisciplina = filter_input(INPUT_POST, 'inputUrlFotoDisciplina', FILTER_SANITIZE_URL);
$inputUrlSiteDisciplina = filter_input(INPUT_POST, 'inputUrlSiteDisciplina', FILTER_SANITIZE_URL);

// validações
$sucesso = false;
$campos = false;
$erro_sql = false;

if (empty($inputNomeDisciplina) || empty($textareaDescricaoDisciplina)  || empty($inputUrlThumbDisciplina)  || empty($inputUrlFotoDisciplina)) {
    $campos = true;
}

if (!$campos) {
    if ($mysqli->query("INSERT INTO disciplina (nomeDisciplina,descricaoDisciplina,tagsDisciplina,urlThumbDisciplina,urlFotoDisciplina,urlSiteDisciplina) VALUES ('$inputNomeDisciplina','$textareaDescricaoDisciplina','$inputTagsDisciplina','$inputUrlThumbDisciplina','$inputUrlFotoDisciplina','$inputUrlSiteDisciplina')")) {
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