<?php

include_once '../util/connect.php';

if (isset($_GET['id'])) {

    $idProfessor = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $sql1 = $mysqli->query("SELECT idDisciplina FROM professor_disciplina WHERE idProfessor=" . $idProfessor);
    $sql2 = $mysqli->query("SELECT * FROM disciplina ORDER BY nomeDisciplina ASC");

    $arrayDisciplinas = array();

    $count = 0;
    while ($rowProfessor = $sql1->fetch_array()) {
        $idDisciplinaProfessor[$count] = $rowProfessor['idDisciplina'];
        //echo "idDisciplinaProfessor: " . $idDisciplinaProfessor[$count] . "<br>";
        //echo "Posição Y: " . $count . "<br><br>";
        $count++;
    }

    $count = 0;
    while ($rowGeral = $sql2->fetch_array()) {
        $idDisciplina[$count] = $rowGeral['id'];
        //echo "idDisciplina: " . $idDisciplina[$count] . "<br>";
        $nomeDisciplina[$count] = $rowGeral['nomeDisciplina'];
        //echo "nomeDisciplina: " . $nomeDisciplina[$count] . "<br>";
        //echo "Posição X: " . $count . "<br><br>";
        $count++;
    }

    //echo "Quantia de IDS: " . sizeof($idDisciplina) . "<br><br>";

    $i = 0;
    for ($count = 0; $count < sizeof($idDisciplina); $count++) {
        if (isset($idDisciplinaProfessor[$i])) {
            if ($idDisciplinaProfessor[$i] == $idDisciplina[$count]) {
                $arrayDisciplinas[$count] = array(
                    'id' => $idDisciplina[$count],
                    'nomeDisciplina' => $nomeDisciplina[$count],
                    'selecionado' => 'true'
                );
                $i++;
            } else {
                $arrayDisciplinas[$count] = array(
                    'id' => $idDisciplina[$count],
                    'nomeDisciplina' => $nomeDisciplina[$count],
                    'selecionado' => 'false'
                );
            }
        } else {
            $arrayDisciplinas[$count] = array(
                'id' => $idDisciplina[$count],
                'nomeDisciplina' => $nomeDisciplina[$count],
                'selecionado' => 'false'
            );
        }
    }
} else if ($idProfessor = '0') {
    $sql = $mysqli->query("SELECT * FROM disciplina ORDER BY nomeDisciplina ASC");
    $i = 0;
    while ($row = $sql->fetch_array()) {
        $arrayDisciplinas[$i] = array(
            'id' => $row["id"],
            'nomeDisciplina' => $row["nomeDisciplina"],
            'selecionado' => 'false'
        );
        $i++;
    }
} else {
    $sql = $mysqli->query("SELECT * FROM disciplina ORDER BY nomeDisciplina ASC");
    $i = 0;
    while ($row = $sql->fetch_array()) {
        $arrayDisciplinas[$i] = array(
            'id' => $row["id"],
            'nomeDisciplina' => $row["nomeDisciplina"],
            'selecionado' => 'false'
        );
        $i++;
    }
}

$json = json_encode($arrayDisciplinas);

if ($json)
    echo $json;
else
    echo json_last_error_msg();