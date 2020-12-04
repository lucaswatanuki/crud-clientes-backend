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
    }

    $sql = "INSERT INTO `cliente`(`id`,`nome`,`rg`) VALUES (null,'{$nome}','{$rg}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $response = [
            'nome' => $nome,
            'rg' => $rg,
            'id' => mysqli_insert_id($con)
        ];
        echo json_encode($response);
    } else {
        http_response_code(422);
    }
}