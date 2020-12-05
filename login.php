<?php

require('./config/conexao.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    if (!empty($con)) {
        $username = mysqli_real_escape_string($con, $request->username);
    }

    $sql = "SELECT * FROM usuario where username='$username'";

    if ($result = mysqli_query($con, $sql)) {
        http_response_code(200);
        $row = mysqli_fetch_assoc($result);
        if (password_verify($request->password, $row['password'])) {
            $response = [
                "username" => $row['username']
            ];
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(401);
        }
    } else {
        http_response_code(404);
    }
}