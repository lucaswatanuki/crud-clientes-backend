<?php

include 'config/conexao.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (trim($request->nome) === '') {
        return http_response_code(400);
    }

    if (!empty($con)) {
        $nome = $con->real_escape_string($request->nome);
        $rg = $con->real_escape_string($request->rg);
        $cpf = $con->real_escape_string($request->cpf);
        $telefone = $con->real_escape_string($request->telefone);
        $dataNascimento = $con->real_escape_string($request->dataNascimento);
    }

    $queryCliente = "INSERT INTO `cliente`(`id`,`nome`,`rg`, `cpf`, `telefone`, `dataNascimento`) 
            VALUES (null,'{$nome}','{$rg}', '{$cpf}', '{$telefone}', '{$dataNascimento}')";

    if ($con->query($queryCliente)) {
        $clienteId = $con->insert_id;
        $i = 0;
        $nomeEndereco = $request->endereco->nome;
        $numero = $request->endereco->numero;
        $cep = $request->endereco->cep;
        $cidade = $request->endereco->cidade;
        $estado = $request->endereco->estado;

        $queryEndereco = "INSERT INTO `endereco`(`id`,`nome`,`numero`, `cep`,`cidade`, `estado`, `idCliente`) 
            VALUES (null,'{$nomeEndereco}','{$numero}', '{$cep}', '{$cidade}', '{$estado}','{$clienteId}')";

        $con->query($queryEndereco);


        http_response_code(201);
        $response = [
            'mensagem' => "Cliente cadastrado com sucesso",
        ];
        echo json_encode($response);
    } else {
        http_response_code(422);
    }
}