<?php

include 'config/conexao.php';

try {

    $query = "INSERT INTO cliente SET nome=:nome, rg=:rg, 
    cpf=:cpf, telefone:telefone, dataNascimento:dataNascimento";

    if (!empty($con)) {
        $stmt = $con->prepare($query);
    }

    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $dataNascimento = $_POST['dataNascimento'];

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':rg', $rg);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telefone', $cpf);
    $stmt->bindParam(':dataNascimento', $dataNascimento);

    if (trim($nome) === '' || $rg === '' || $cpf === '') {
        return http_response_code(400);
    }

    if ($stmt->execute()) {
        $response = [
            'nome' => $nome,
            'rg' => $rg,
            'cpf' => $cpf
        ];
        echo json_encode($response);
    } else {
        echo json_encode(array('sucesso' => false));
    }
} catch (PDOException $exception) {
    die('Exceção: ' . $exception->getMessage());
}