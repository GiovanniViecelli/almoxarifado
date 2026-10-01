<?php

$host = "192.168.10.23";
$port = "5432";
$dbname = "almoxarifado";
$user = "postgres";
$password = "12345";

try {

    $conexao = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo json_encode([
        "erro" => "Erro na conexão com o banco"
    ]);

}

?>