<?php

include 'config/conexao.php';

if (!empty($con)) {
    $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? $con->real_escape_string((int)$_GET['id']) : false;
}

if(!$id)
{
    return http_response_code(400);
}

$enderecos = [];
$sql = "SELECT * FROM endereco WHERE `idCliente` ='{$id}'";

if (!empty($con)) {
    if ($result = $con->query($sql)) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $enderecos[$i]['id'] = $row['id'];
            $enderecos[$i]['nome'] = $row['nome'];
            $enderecos[$i]['numero'] = $row['numero'];
            $enderecos[$i]['cep'] = $row['cep'];
            $enderecos[$i]['cidade'] = $row['cidade'];
            $enderecos[$i]['estado'] = $row['estado'];
            $i++;
        }
        echo json_encode($enderecos);
    } else {
        http_response_code(404);
    }
}