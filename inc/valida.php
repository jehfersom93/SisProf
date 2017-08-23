<?php

require_once("seguranca.php");

$sucesso = false;
$erro = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailProfessor = (isset($_POST['emailProfessor'])) ? $_POST['emailProfessor'] : '';
    $senhaProfessor = (isset($_POST['senhaProfessor'])) ? $_POST['senhaProfessor'] : '';
    if (validaUsuario($emailProfessor, $senhaProfessor) == true) {
        $sucesso = true;
    } else {
        expulsaVisitante();
        $erro = true;
    }

    $response_array = array(
        'sucesso' => $sucesso,
        'erro' => $erro
    );

    $json = json_encode($response_array);

    if ($json)
        echo $json;
    else
        echo json_last_error_msg();
}