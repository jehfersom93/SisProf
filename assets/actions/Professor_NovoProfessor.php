<?php

include_once '../util/connect.php';

$idInstituicao = filter_input(INPUT_POST, 'idInstituicao', FILTER_VALIDATE_INT);
$inputEmail = filter_input(INPUT_POST, 'inputEmail', FILTER_VALIDATE_EMAIL);
$inputNome = filter_input(INPUT_POST, 'inputNome', FILTER_SANITIZE_STRING);
$inputTelefone = filter_input(INPUT_POST, 'inputTelefone', FILTER_SANITIZE_STRING);
$selectEstado = filter_input(INPUT_POST, 'selectEstado', FILTER_SANITIZE_STRING);
$selectCidade = filter_input(INPUT_POST, 'selectCidade', FILTER_SANITIZE_STRING);
$inputEndereco = filter_input(INPUT_POST, 'inputEndereco', FILTER_SANITIZE_STRING);
$inputUrlFotoPerfil = filter_input(INPUT_POST, 'inputUrlFotoPerfil', FILTER_SANITIZE_URL);
$inputUrlImagemCapa = filter_input(INPUT_POST, 'inputUrlImagemCapa', FILTER_SANITIZE_URL);
$inputCurriculo = filter_input(INPUT_POST, 'inputCurriculo', FILTER_SANITIZE_URL);
$inputFacebook = filter_input(INPUT_POST, 'inputFacebook', FILTER_SANITIZE_URL);
$inputTwitter = filter_input(INPUT_POST, 'inputTwitter', FILTER_SANITIZE_URL);
$inputGoogle = filter_input(INPUT_POST, 'inputGoogle', FILTER_SANITIZE_URL);
$inputInstagram = filter_input(INPUT_POST, 'inputInstagram', FILTER_SANITIZE_URL);
$inputLinkedin = filter_input(INPUT_POST, 'inputLinkedin', FILTER_SANITIZE_URL);
$inputSenha = filter_input(INPUT_POST, 'inputSenha');
$inputCargo = filter_input(INPUT_POST, 'inputCargo', FILTER_SANITIZE_STRING);
$inputDataInicial = filter_input(INPUT_POST, 'inputDataInicial');
$inputDataFinal = filter_input(INPUT_POST, 'inputDataFinal');
$selectFormacoes = $_POST['selectFormacoes'];
$selectDisciplinas = $_POST['selectDisciplinas'];
$inputAtividade = filter_input(INPUT_POST, 'inputAtividade', FILTER_SANITIZE_STRING);
$textareaSobre = filter_input(INPUT_POST, 'textareaSobre', FILTER_SANITIZE_STRING);

// validações
$sql1 = false;
$sql2 = false;
$sql3 = false;
$sql4 = false;
$sql5 = false;
$sucesso = false;
$existente = false;
$campos = false;
$erro_sql = false;

// formatação das datas
$dataInicial = str_replace('/', '-', $inputDataInicial);
$dataInicialF = date('Y-m-d', strtotime($dataInicial));
if (!empty($inputDataFinal)) {
    $dataFinal = str_replace('/', '-', $inputDataFinal);
    $dataFinalF = date('Y-m-d', strtotime($dataFinal));
}

$results = $mysqli->query("SELECT emailProfessor FROM professor");
while ($row = $results->fetch_array()) {
    $_email = $row["emailProfessor"];
    if ($_email == $inputEmail) {
        $existente = true;
        break;
    }
}

if (empty($inputDataFinal)) {
    $dataFinalF = NULL;
}

if (empty($inputEmail) || empty($inputNome) || empty($selectCidade) || empty($selectEstado) || empty($textareaSobre) || empty($selectFormacoes) || empty($selectDisciplinas) || empty($inputAtividade) || empty($inputCargo) || empty($inputDataInicial)) {
    $campos = true;
}

if (!$campos && !$existente) {
    if ($mysqli->query("INSERT INTO professor (nomeProfessor,emailProfessor,senhaProfessor,cidadeProfessor,estadoProfessor,enderecoProfessor,telefoneProfessor,textoSobreProfessor,urlFotoProfessor,urlCapaProfessor,urlCurriculumProfessor,facebookProfessor,twitterProfessor,googleProfessor,instagramProfessor,linkedinProfessor) VALUES('$inputNome','$inputEmail','$inputSenha','$selectCidade','$selectEstado','$inputEndereco','$inputTelefone','$textareaSobre','$inputUrlFotoPerfil','$inputUrlImagemCapa','$inputCurriculo','$inputFacebook','$inputTwitter','$inputGoogle','$inputInstagram','$inputLinkedin')")) {
        $sql1 = true;
    }

    $sql = $mysqli->query("SELECT MAX(id) FROM professor");
    while ($row = $sql->fetch_array()) {
        $idAtual = $row['MAX(id)'];
    }
    if ($mysqli->query("INSERT INTO professor_instituicao (idProfessor,idInstituicao,cargoProfessor,atividadeProfessor,dataInicial,dataFinal) VALUES ('$idAtual','$idInstituicao','$inputCargo','$inputAtividade','$dataInicialF','$dataFinalF')")) {
        $sql2 = true;
    }

    foreach ($selectFormacoes as $idFormacao) {
        if ($mysqli->query("INSERT INTO professor_formacao (idProfessor,idFormacao) VALUES ('$idAtual','$idFormacao')")) {
            if ($mysqli->query("UPDATE formacao SET sendoUsada='1' WHERE id=" . $idFormacao)) {
                $sql3 = true;
            }
        }
    }

    foreach ($selectDisciplinas as $idDisciplina) {
        if ($mysqli->query("INSERT INTO professor_disciplina (idProfessor,idDisciplina) VALUES ('$idAtual','$idDisciplina')")) {
            if ($mysqli->query("UPDATE disciplina SET sendoUsada='1' WHERE id=" . $idDisciplina)) {
                $sql4 = true;
            }
        }
    }

    if ($mysqli->query("UPDATE instituicao SET sendoUsada='1' WHERE id=" . $idInstituicao)) {
        $sql5 = true;
    }
}


if ($sql1 && $sql2 && $sql3 && $sql4 && $sql5) {
    $sucesso = true;
} else {
    $erro_sql = true;
}

if ($erro_sql && $existente) {
    $erro_sql = false;
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