<?php
//require conexão
require_once('../../db/conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    //pendente - em andamento - pausado - concluido
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data_entrega = filter_input(INPUT_POST, 'data_entrega', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id_responsavel = filter_input(INPUT_POST, 'id_responsavel', FILTER_VALIDATE_INT);
    $id_criador = filter_input(INPUT_POST, 'id_criador', FILTER_VALIDATE_INT);

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO tarefas (descricao, data_entrega, id_responsavel, id_criador) VALUES ('$descricao', '$data_entrega', '$id_responsavel','$id_criador')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../../dashboard.php');
        exit;
    } else {
        header('Location: ../../dashboard.php?Erro=Erro ao criar a tarefa!');
        exit;
    }
}


// Fecha a conexão com o banco de dados
$conn->close();
