<?php

$_SG['conectaServidor'] = true;
$_SG['abreSessao'] = true;
$_SG['caseSensitive'] = false;
$_SG['validaSempre'] = true;
$_SG['servidor'] = 'localhost';
$_SG['usuario'] = 'sitegeral';
$_SG['senha'] = 'abracadabra';
$_SG['banco'] = 'sitegeral';
$_SG['paginaLogin'] = 'index.php';
$_SG['tabela'] = 'professor';

$erro_sql = false;

if ($_SG['conectaServidor'] == true) {
    $_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor [" . $_SG['servidor'] . "].");
    mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados [" . $_SG['banco'] . "].");
}

if ($_SG['abreSessao'] == true)
    session_start();

function validaUsuario($emailProfessor, $senhaProfessor) {
    global $_SG;
    //$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

    $nusuario = addslashes($emailProfessor);
    $nsenha = addslashes($senhaProfessor);

    $sql = "SELECT `id`, `emailProfessor` FROM `" . $_SG['tabela'] . "` WHERE `emailProfessor` = '" . $nusuario . "' AND `senhaProfessor` = '" . $nsenha . "' LIMIT 1";
    $query = mysql_query($sql);
    $resultado = mysql_fetch_assoc($query);

    if (empty($resultado)) {
        $erro_sql = true;
        echo $erro_sql;
        return false;
    } else {
        $_SESSION['usuarioID'] = $resultado['id'];
        $_SESSION['emailProfessor'] = $resultado['emailProfessor'];
        if ($_SG['validaSempre'] == true) {
            $_SESSION['professorLogin'] = $emailProfessor;
            $_SESSION['professorSenha'] = $senhaProfessor;
        }
        return true;
    }
}

function protegePagina() {
    global $_SG;
    if (!isset($_SESSION['usuarioID']) OR ! isset($_SESSION['emailProfessor'])) {
        expulsaVisitante();
    } else if (!isset($_SESSION['usuarioID']) OR ! isset($_SESSION['emailProfessor'])) {
        if ($_SG['validaSempre'] == true) {
            if (!validaUsuario($_SESSION['professorLogin'], $_SESSION['professorSenha'])) {
                expulsaVisitante();
            }
        }
    }
}

function expulsaVisitante() {
    global $_SG;
    unset($_SESSION['usuarioID'], $_SESSION['emailProfessor'], $_SESSION['professorLogin'], $_SESSION['professorSenha']);
    header("location:http://kraft.ads.cnecsan.edu.br/~jefersonrodrigues/sitecurso/index.php?id=1");
}
