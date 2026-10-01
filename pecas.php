<?php

require "conexao.php";

header("Content-Type: application/json");

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {

    $dados = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($dados["nome"]) ||
        !isset($dados["categoria"]) ||
        !isset($dados["fornecedor"]) ||
        !isset($dados["quantidade"]) ||
        !isset($dados["preco_unitario"])
    ) {
        echo json_encode(["erro" => "Preencha todos os campos"]);
        exit;
    }

    if (!in_array($dados["categoria"], ["eletrica", "mecanica", "hidraulica"])) {
        echo json_encode(["erro" => "Categoria inválida"]);
        exit;
    }

    if ($dados["quantidade"] < 0) {
        echo json_encode(["erro" => "Quantidade não pode ser negativa"]);
        exit;
    }

    if ($dados["preco_unitario"] <= 0) {
        echo json_encode(["erro" => "Preço deve ser maior que zero"]);
        exit;
    }

    $sql = "INSERT INTO pecas
    (nome, categoria, fornecedor, quantidade, preco_unitario)
    VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        $dados["nome"],
        $dados["categoria"],
        $dados["fornecedor"],
        $dados["quantidade"],
        $dados["preco_unitario"]
    ]);

    echo json_encode(["mensagem" => "Peça cadastrada com sucesso"]);
}


elseif ($metodo == "GET") {

    $sql = "SELECT * FROM pecas";

    $stmt = $conexao->query($sql);

    $pecas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($pecas);
}


elseif ($metodo == "PUT") {

    $dados = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($dados["id"]) ||
        !isset($dados["nome"]) ||
        !isset($dados["categoria"]) ||
        !isset($dados["fornecedor"]) ||
        !isset($dados["quantidade"]) ||
        !isset($dados["preco_unitario"])
    ) {
        echo json_encode(["erro" => "Preencha todos os campos"]);
        exit;
    }

    if (!in_array($dados["categoria"], ["eletrica", "mecanica", "hidraulica"])) {
        echo json_encode(["erro" => "Categoria inválida"]);
        exit;
    }

    if ($dados["quantidade"] < 0) {
        echo json_encode(["erro" => "Quantidade não pode ser negativa"]);
        exit;
    }

    if ($dados["preco_unitario"] <= 0) {
        echo json_encode(["erro" => "Preço deve ser maior que zero"]);
        exit;
    }

    $sql = "UPDATE pecas SET
    nome = ?,
    categoria = ?,
    fornecedor = ?,
    quantidade = ?,
    preco_unitario = ?
    WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        $dados["nome"],
        $dados["categoria"],
        $dados["fornecedor"],
        $dados["quantidade"],
        $dados["preco_unitario"],
        $dados["id"]
    ]);

    echo json_encode(["mensagem" => "Peça atualizada com sucesso"]);
}


elseif ($metodo == "DELETE") {

    $dados = json_decode(file_get_contents("php://input"), true);

    if (!isset($dados["id"])) {
        echo json_encode(["erro" => "Informe o id"]);
        exit;
    }

    $sql = "DELETE FROM pecas WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([$dados["id"]]);

    echo json_encode(["mensagem" => "Peça excluída com sucesso"]);
}
elseif ($metodo == "GET") {

    $sql = "SELECT * FROM pecas";

    $stmt = $conexao->query($sql);

    $pecas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($pecas);
}
elseif ($metodo == "DELETE") {

    $dados = json_decode(file_get_contents("php://input"), true);

    if (!isset($dados["id"])) {
        echo json_encode(["erro" => "Informe o id"]);
        exit;
    }

    $sql = "DELETE FROM pecas WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([$dados["id"]]);

    echo json_encode(["mensagem" => "Peça excluída com sucesso"]);
}

?>