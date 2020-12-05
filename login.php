<?php

require('./config/conexao.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    if (!empty($con)) {
        $username = mysqli_real_escape_string($con, trim($request->username));
    }

    $sql = "SELECT * FROM usuario where username='$username'";

    if ($result = mysqli_query($con, $sql)) {
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($request->password, $row['password'])) {
                http_response_code(201);
                $response = [
                    "id" => $row['id'],
                    "username" => $row['username']
                ];
                echo json_encode($response);
            } else http_response_code(401);
        }
        http_response_code(401);
    } else {
        http_response_code(404);
    }
}