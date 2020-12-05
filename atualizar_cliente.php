<?php

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if ((int)$request->id < 1 || trim($request->number) == '' || (float)$request->amount < 0) {
        return http_response_code(400);
    }

    if (!empty($con)) {
        $id = $con->real_escape_string((int)$request->id);
        $nome = $con->real_escape_string($request->nome);
        $rg = $con->real_escape_string($request->rg);
        $cpf = $con->real_escape_string($request->cpf);
        $telefone = $con->real_escape_string($request->telefone);
        $dataNascimento = $con->real_escape_string($request->dataNascimento);
    }

    $queryCliente = "UPDATE `cliente` SET `nome`='$nome',`rg`='$rg', `cpf`='$cpf', `telefone`='$telefone', `dataNascimento`='$dataNascimento' 
            WHERE `id` = '{$id}' LIMIT 1";

    if ($con->query($queryCliente)) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}