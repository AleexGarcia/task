<?php
//require conexão
require_once('../../db/conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nivel = filter_input(INPUT_POST, 'nivel', FILTER_VALIDATE_INT);

    // Insere o novo usuário no banco de dados
    // nivel: 1 - usuário padrão , 2 - coordenador , 3 - admin
    if($nivel){
        //admin
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha', nivel = '$nivel' WHERE id = $id";
    }else{
        //outros
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: ../../dashboard.php');
        exit;
    } else {
        header('Location: ../../perfil.php?Erro=Erro ao fazer o update');
        exit;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
