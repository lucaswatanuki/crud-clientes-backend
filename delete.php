<?php

include 'config/conexao.php';

if (!empty($con)) {
    $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0) ? $con->real_escape_string((int)$_GET['id']) : false;
}

if (!$id) {
    return http_response_code(400);
}

$queryEndereco = "DELETE FROM `endereco` WHERE `idCliente` ='{$id}'";
$queryCliente = "DELETE FROM `cliente` WHERE `id` ='{$id}' LIMIT 1";

if ($con->query($queryEndereco)) {
    if ($con->query($queryCliente)) {
        http_response_code(204);
    }
} else {
    return http_response_code(422);
}