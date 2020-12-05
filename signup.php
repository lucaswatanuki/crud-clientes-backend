<?php

include 'config/conexao.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if (trim($request->username) === '') {
        return http_response_code(400);
    }

    $pwd_criptografada = password_hash($request->password, PASSWORD_DEFAULT);

    if (!empty($con)) {
        $username = mysqli_real_escape_string($con, $request->username);
        $password = mysqli_real_escape_string($con, $pwd_criptografada);
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