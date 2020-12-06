<?php

include 'config/conexao.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if ((int)$request->id < 1) {
        return http_response_code(400);
    }

    if (!empty($con)) {
        $id = $con->real_escape_string((int)$request->id);
        $nome = $con->real_escape_string($request->nome);
        $numero = $con->real_escape_string($request->numero);
        $cep = $con->real_escape_string($request->cep);
        $cidade = $con->real_escape_string($request->cidade);
        $estado = $con->real_escape_string($request->estado);
    }

    $query = "UPDATE `endereco` SET `nome`='$nome',`numero`='$numero', `cep`='$cep', `cidade`='$cidade', `estado`='$estado' 
            WHERE `id` = '{$id}'";

    if ($con->query($query)) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}