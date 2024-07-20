<?php

$host = "localhost";
$db = "escola_ead";
$user = "root";
$pass = "root";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
  die("Falha na conexão! " . $mysqli->connect_error);
} 

?>