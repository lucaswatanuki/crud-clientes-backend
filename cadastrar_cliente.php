<?php

include 'config/conexao.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (trim($request->nome) === '') {
        return http_response_code(400);
    }

    if (!empty($con)) {
        $nome = mysqli_real_escape_string($con, trim($request->nome));
        $rg = mysqli_real_escape_string($con, $request->rg);
        $cpf = mysqli_real_escape_string($con, $request->cpf);
        $telefone = mysqli_real_escape_string($con, $request->telefone);
        $dataNascimento = mysqli_real_escape_string($con, $request->dataNascimento);
    }

    $queryCliente = "INSERT INTO `cliente`(`id`,`nome`,`rg`, `cpf`, `telefone`, `dataNascimento`) 
            VALUES (null,'{$nome}','{$rg}', '{$cpf}', '{$telefone}', '{$dataNascimento}')";

    if (mysqli_query($con, $queryCliente)) {
        http_response_code(201);
        $response = [
            'mensagem' => "Cliente cadastrado com sucesso",
        ];
        echo json_encode($response);
    } else {
        http_response_code(422);
    }
}