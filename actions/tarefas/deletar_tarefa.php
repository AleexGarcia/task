<?php
require_once('../../db/conexao.php');

// Verifica id foi recebido
if (isset($_GET['id'])) {

    // Obtém os dados
    $id = $_GET['id'];

    // Insere o novo usuário no banco de dados
    $sql = "DELETE FROM tarefas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../../dashboard.php');
        exit;
    } else {
        header('Location: ../../dashboard.php?Erro=Erro ao deletar a tarefa!');
        exit;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
