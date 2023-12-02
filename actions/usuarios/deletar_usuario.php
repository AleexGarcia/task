<?php
require_once('../../db/conexao.php');

// Verifica id foi recebido
if (isset($_GET['id'])) {

    // Obtém os dados
    $id = $_GET['id'];

    // Insere o novo usuário no banco de dados
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../../gerenciar-usuarios.php');
        exit;
    } else {
        header('Location: ../../gerenciar-usuarios.php?Erro=Erro ao deletar usuário!');
        exit;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
