<?php

include_once '../util/connect.php';

$idProfessor = filter_input(INPUT_POST, 'idProfessor', FILTER_VALIDATE_INT);
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
$inputNovaSenha = filter_input(INPUT_POST, 'inputNovaSenha');
$inputCargo = filter_input(INPUT_POST, 'inputCargo', FILTER_SANITIZE_STRING);
$inputDataInicial = filter_input(INPUT_POST, 'inputDataInicial');
$inputDataFinal = filter_input(INPUT_POST, 'inputDataFinal');
$selectFormacoes = $_POST['selectFormacoes'];
$selectDisciplinas = $_POST['selectDisciplinas'];
$inputAtividade = filter_input(INPUT_POST, 'inputAtividade', FILTER_SANITIZE_STRING);
$textareaSobre = filter_input(INPUT_POST, 'textareaSobre', FILTER_SANITIZE_STRING);

// validações
$sqlUpdateProfessor = false;
$sqlUpdateProfessorInstituicao = false;
$sqlUpdateInstituicao1 = false;
$sqlUpdateInstituicao2 = false;
$sqlUpdateFormacoes1 = false;
$sqlUpdateFormacoes2 = false;
$sqlUpdateDisciplinas1 = false;
$sqlUpdateDisciplinas2 = false;
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

// dados antigos
$results = $mysqli->query("SELECT senhaProfessor,emailProfessor,urlFotoProfessor,urlCapaProfessor FROM professor WHERE id=" . $idProfessor);
while ($row = $results->fetch_array()) {
    $emailAtual = $row['emailProfessor'];
    $fotoPerfilAtual = $row['urlFotoProfessor'];
    $imagemCapaAtual = $row['urlCapaProfessor'];
    $senhaAtual = $row['senhaProfessor'];
}

$results = $mysqli->query("SELECT emailProfessor FROM professor");
while ($row = $results->fetch_array()) {
    $_email = $row["emailProfessor"];
    if ($_email == $inputEmail) {
        if ($_email != $emailAtual) {
            $existente = true;
        }
        break;
    }
}

if (empty($inputUrlFotoPerfil)) {
    $inputUrlFotoPerfil = $fotoPerfilAtual;
}
if (empty($inputUrlImagemCapa)) {
    $inputUrlImagemCapa = $imagemCapaAtual;
}
if (empty($inputNovaSenha)) {
    $inputNovaSenha = $senhaAtual;
}
if (empty($inputDataFinal)) {
    $dataFinalF = NULL;
}

if (empty($inputEmail) || empty($inputNome) || empty($selectCidade) || empty($selectEstado) || empty($textareaSobre) || empty($inputAtividade) || empty($inputCargo) || empty($inputDataInicial)) {
    $campos = true;
}

if (!$campos && !$existente) {
    if ($mysqli->query("UPDATE professor SET nomeProfessor='$inputNome',emailProfessor='$inputEmail',senhaProfessor='$inputNovaSenha',cidadeProfessor='$selectCidade',estadoProfessor='$selectEstado',enderecoProfessor='$inputEndereco',telefoneProfessor='$inputTelefone',textoSobreProfessor='$textareaSobre',urlFotoProfessor='$inputUrlFotoPerfil',urlCapaProfessor='$inputUrlImagemCapa',urlCurriculumProfessor='$inputCurriculo',facebookProfessor='$inputFacebook',twitterProfessor='$inputTwitter',googleProfessor='$inputGoogle',instagramProfessor='$inputInstagram',linkedinProfessor='$inputLinkedin' WHERE id=" . $idProfessor)) {
        $sqlUpdateProfessor = true;
    }

    if ($mysqli->query("UPDATE professor_instituicao SET idInstituicao='$idInstituicao',cargoProfessor='$inputCargo',atividadeProfessor='$inputAtividade',dataInicial='$dataInicialF',dataFinal='$dataFinalF' WHERE idProfessor=" . $idProfessor)) {
        $sqlUpdateProfessorInstituicao = true;
    }
    $results = $mysqli->query("SELECT instituicao.id FROM instituicao INNER JOIN professor_instituicao ON instituicao.id=professor_instituicao.idInstituicao WHERE instituicao.sendoUsada=1 AND professor_instituicao.idProfessor=" . $idProfessor);
    while ($row = $results->fetch_array()) {
        $instituicaoAtual = $row['id'];
        if ($mysqli->query("UPDATE instituicao SET sendoUsada=0 WHERE id=" . $instituicaoAtual)) {
            $sqlUpdateInstituicao1 = true;
        }
    }
    if ($mysqli->query("UPDATE instituicao SET sendoUsada=1 WHERE id=" . $idInstituicao)) {
        $sqlUpdateInstituicao2 = true;
    }

    $results = $mysqli->query("SELECT formacao.id FROM formacao INNER JOIN professor_formacao ON formacao.id=professor_formacao.idFormacao WHERE professor_formacao.idProfessor=" . $idProfessor);
    while ($row = $results->fetch_array()) {
        $idFormacoesAtuais = $row['id'];
        if ($mysqli->query("UPDATE formacao SET sendoUsada=0 WHERE id=" . $idFormacoesAtuais)) {
            $sqlUpdateFormacoes1 = true;
        }
    }
    if ($mysqli->query("DELETE FROM professor_formacao WHERE idProfessor=" . $idProfessor)) {
        foreach ($selectFormacoes as $idFormacao) {
            if ($mysqli->query("INSERT INTO professor_formacao (idProfessor,idFormacao) VALUES ('$idProfessor','$idFormacao')")) {
                if ($mysqli->query("UPDATE formacao SET sendoUsada=1 WHERE id=" . $idFormacao)) {
                    $sqlUpdateFormacoes2 = true;
                }
            }
        }
    }

    $results = $mysqli->query("SELECT disciplina.id FROM disciplina INNER JOIN professor_disciplina ON disciplina.id=professor_disciplina.idDisciplina WHERE professor_disciplina.idProfessor=" . $idProfessor);
    while ($row = $results->fetch_array()) {
        $idDisciplinasAtuais = $row['id'];
        if ($mysqli->query("UPDATE disciplina SET sendoUsada=0 WHERE id=" . $idDisciplinasAtuais)) {
            $sqlUpdateDisciplinas1 = true;
        }
    }
    if ($mysqli->query("DELETE FROM professor_disciplina WHERE idProfessor=" . $idProfessor)) {
        foreach ($selectDisciplinas as $idDisciplina) {
            if ($mysqli->query("INSERT INTO professor_disciplina (idProfessor,idDisciplina) VALUES ('$idProfessor','$idDisciplina')")) {
                if ($mysqli->query("UPDATE disciplina SET sendoUsada=1 WHERE id=" . $idDisciplina)) {
                    $sqlUpdateDisciplinas2 = true;
                }
            }
        }
    }
}

if ($sqlUpdateProfessor && $sqlUpdateProfessorInstituicao && $sqlUpdateFormacoes1 && $sqlUpdateFormacoes2 && $sqlUpdateDisciplinas1 && $sqlUpdateDisciplinas2 && $sqlUpdateInstituicao1 && $sqlUpdateInstituicao2) {
    $sucesso = true;
} else {
    $erro_sql = true;
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