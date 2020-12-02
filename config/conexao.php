<?php

// used to connect to the database
$host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

catch(PDOException $exception){
    echo "Erro conexão: " . $exception->getMessage();
}
