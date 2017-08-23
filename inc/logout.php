<?php
include("seguranca.php");
expulsaVisitante();

$sucesso = true;
$response_array = array(
    'sucesso' => $sucesso
);
$json = json_encode($response_array);
if ($json)
    echo $json;
else
    echo json_last_error_msg();