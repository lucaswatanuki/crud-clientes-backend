<?php

include 'config/conexao.php';

$clientes = [];
$sql = "SELECT * FROM cliente";

if (!empty($con)) {
    if ($result = mysqli_query($con, $sql)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $clientes[$i]['id'] = $row['id'];
            $clientes[$i]['nome'] = $row['nome'];
            $clientes[$i]['rg'] = $row['rg'];
            $clientes[$i]['cpf'] = $row['cpf'];
            $clientes[$i]['telefone'] = $row['telefone'];
            $clientes[$i]['dataNascimento'] = $row['dataNascimento'];

            $i++;
        }

        echo json_encode($clientes);
    } else {
        http_response_code(404);
    }
}