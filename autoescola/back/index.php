<?php

require "config.php";

$rota = $_GET["rota"] ?? ($_SERVER["REQUEST_METHOD"]=== "POST" ? "autoescola": "teste");

function teste() {
    echo "API respondendo com sucesso!";
}

function createAlunos($con){
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $data_nascimento = $_POST["data_nascimento"] ?? "";
        try {
            $stmt = $con->prepare("INSERT INTO Alunos (nome, email, telefone, data_nascimento) VALUES (?,?,?,?)");
            $stmt -> execute([$nome, $email, $telefone, $data_nascimento]);
        }catch(PDOExeption $e){
    exit;
        }
}
function readAlunos($con){
    header("Content-Type: application/json; charset=utf-8");
    $stmt = $con->query("SELECT * FROM Alunos");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

if ($rota === "create/alunos"){
    createAlunos($con);
}elseif ($rota === "read/alunos"){
    readAlunos($con);
}else {
    teste();
}
?> 