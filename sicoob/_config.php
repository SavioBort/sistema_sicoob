<?php

	session_start();

    // Conecta com o banco de dados

    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $dbname = "sicoob_credivar";
    $conn;
    $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $pass);
    date_default_timezone_set('America/Sao_Paulo');
  