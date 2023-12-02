<?php
//require conexão
require_once('../../db/conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nivel = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // Consulta para verificar se o email já está em uso
    $checkEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultEmail = $conn->query($checkEmail);
    
    if ($resultEmail->num_rows > 0) {
        header('Location: ../../cadastro.php?Erro=Email já cadastrado!');
        exit;
    } else {
        // Insere o novo usuário no banco de dados
        $hash_senha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('$nome', '$email', '$hash_senha', 1)";

        if ($conn->query($sql) === TRUE) {
            header('Location: ../../index.php');
            exit;
        } else {
            header('Location: ../../cadastro.php?Erro=Erro no servidor!');
            exit;
        }
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
