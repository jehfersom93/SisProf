<?php

include_once '../util/connect.php';

if (isset($_GET['id'])) {

    $idProfessor = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $sql1 = $mysqli->query("SELECT idFormacao FROM professor_formacao WHERE idProfessor=" . $idProfessor);
    $sql2 = $mysqli->query("SELECT * FROM formacao ORDER BY nomeFormacao ASC");

    $arrayFormacoes = array();

    $count = 0;
    while ($rowProfessor = $sql1->fetch_array()) {
        $idFormacaoProfessor[$count] = $rowProfessor['idFormacao'];
        //echo "idFormacaoProfessor: " . $idFormacaoProfessor[$count] . "<br>";
        //echo "Posição Y: " . $count . "<br><br>";
        $count++;
    }

    $count = 0;
    while ($rowGeral = $sql2->fetch_array()) {
        $idFormacao[$count] = $rowGeral['id'];
        //echo "idFormacao: " . $idFormacao[$count] . "<br>";
        $nomeFormacao[$count] = $rowGeral['nomeFormacao'];
        //echo "nomeFormacao: " . $nomeFormacao[$count] . "<br>";
        //echo "Posição X: " . $count . "<br><br>";
        $count++;
    }

    //echo "Quantia de IDS: " . sizeof($idFormacao) . "<br><br>";

    $i = 0;
    for ($count = 0; $count < sizeof($idFormacao); $count++) {
        if (isset($idFormacaoProfessor[$i])) {
            if ($idFormacaoProfessor[$i] == $idFormacao[$count]) {
                $arrayFormacoes[$count] = array(
                    'id' => $idFormacao[$count],
                    'nomeFormacao' => $nomeFormacao[$count],
                    'selecionado' => 'true'
                );
                $i++;
            } else {
                $arrayFormacoes[$count] = array(
                    'id' => $idFormacao[$count],
                    'nomeFormacao' => $nomeFormacao[$count],
                    'selecionado' => 'false'
                );
            }
        } else {
            $arrayFormacoes[$count] = array(
                'id' => $idFormacao[$count],
                'nomeFormacao' => $nomeFormacao[$count],
                'selecionado' => 'false'
            );
        }
    }
} else if ($idProfessor = '0') {
    $sql = $mysqli->query("SELECT * FROM formacao ORDER BY nomeFormacao ASC");
    $i = 0;
    while ($row = $sql->fetch_array()) {
        $arrayFormacoes[$i] = array(
            'id' => $row["id"],
            'nomeFormacao' => $row["nomeFormacao"],
            'selecionado' => 'false'
        );
        $i++;
    }
} else {
    $sql = $mysqli->query("SELECT * FROM formacao ORDER BY nomeFormacao ASC");
    $i = 0;
    while ($row = $sql->fetch_array()) {
        $arrayFormacoes[$i] = array(
            'id' => $row["id"],
            'nomeFormacao' => $row["nomeFormacao"],
            'selecionado' => 'false'
        );
        $i++;
    }
}

$json = json_encode($arrayFormacoes);

if ($json)
    echo $json;
else
    echo json_last_error_msg();