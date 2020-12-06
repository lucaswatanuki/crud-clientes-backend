<?php

include 'config/conexao.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (!empty($con)) {
        $nome = mysqli_real_escape_string($con, trim($request->nome));
        $numero = mysqli_real_escape_string($con, (int)$request->numero);
        $cep = mysqli_real_escape_string($con, $request->cep);
        $cidade = mysqli_real_escape_string($con, trim($request->cidade));
        $estado = mysqli_real_escape_string($con, trim($request->estado));
        $clienteId = mysqli_real_escape_string($con, (int)$request->clienteId);
    }

    $queryEndereco = "INSERT INTO `endereco`(`id`,`nome`,`numero`, `cep`, `cidade`, `estado`, `idCliente`) 
            VALUES (null,'{$nome}','{$numero}', '{$cep}', '{$cidade}', '{$estado}','{$clienteId}')";

    if (mysqli_query($con, $queryEndereco)) {
        http_response_code(201);
        $response = [
            'mensagem' => "Endereco cadastrado com sucesso",
        ];
        echo json_encode($response);
    } else {
        http_response_code(422);
    }
}