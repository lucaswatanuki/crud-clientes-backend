<?php

require ('./config/conexao.php');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    if (!empty($con)) {
        $pwd = mysqli_real_escape_string($con, trim(md5($request->password)));
        $username = mysqli_real_escape_string($con, trim($request->username));
    }

    $sql = "SELECT * FROM usuario where username='$username' and password='$pwd'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_num_rows($result);

    if ($result = mysqli_query($con, $sql)) {
        http_response_code(200);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        http_response_code(404);
    }
}