<?php

include 'config/conexao.php';

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (trim($request->nome) === '') {
        return http_response_code(400);
    }

    if (!empty($con)) {
        $username = mysqli_real_escape_string($con, trim($request->username));
        $password = mysqli_real_escape_string($con, trim(md5($request->password)));
    }

    $sql = "INSERT INTO `usuario`(`id`,`username`,`password`) VALUES (null,'{$username}','{$password}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $response = [
            'sucesso' => true,
            'mensagem' => "Conta criada com sucesso"
        ];
        echo json_encode($response);
    } else {
        http_response_code(422);
    }
}