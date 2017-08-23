<?php

$servername = "localhost";

// Online
$username = "sitegeral";
$password = "abracadabra";
$db = "sitegeral";

// Offline
//$username = "root";
//$password = "";
//$db = "curso";

$mysqli = new \mysqli($servername, $username, $password, $db);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}