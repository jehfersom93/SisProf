<?php

include_once '../util/connect.php';

$idInstituicao = filter_input(INPUT_POST, 'idInstituicao', FILTER_VALIDATE_INT);
$inputNomeInstituicao = filter_input(INPUT_POST, 'inputNomeInstituicao', FILTER_SANITIZE_STRING);

// validações
$sucesso = false;
$existente = false;
$campos = false;
$erro_sql = false;

$res = $mysqli->query("SELECT * FROM instituicao WHERE id=" . $idInstituicao);
while ($row = $res->fetch_array()) {
    $nomeAtual = $row['nomeInstituicao'];
}

$results = $mysqli->query("SELECT * FROM instituicao");
while ($row = $results->fetch_array()) {
    $_nomeInstituicao = $row["nomeInstituicao"];
    if ($_nomeInstituicao == $inputNomeInstituicao) {
        if ($_nomeInstituicao != $nomeAtual) {
            $existente = true;
        }
        break;
    }
}

if (empty($inputNomeInstituicao)) {
    $campos = true;
}

if (!$campos && !$existente) {
    if ($mysqli->query("UPDATE instituicao SET nomeInstituicao='$inputNomeInstituicao' WHERE id=" . $idInstituicao)) {
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

mysqli_free_result($results);
?>