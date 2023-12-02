<?php
//require conexão
require_once('../../db/conexao.php');

session_start();

$token = isset($_SESSION['token']) ? $_SESSION['token'] : null;
$token = json_decode($token);

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    //pendente - em andamento - pausado - concluido
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data_entrega = filter_input(INPUT_POST, 'data_entrega', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id_responsavel = filter_input(INPUT_POST, 'id_responsavel', FILTER_VALIDATE_INT);

    // Insere o novo usuário no banco de dados
    // nivel: 1 - usuário padrão , 2 - coordenador , 3 - admin

    if ($token->nivel == 'padrao') {
        $sql = "UPDATE tarefas SET status = '$status' WHERE id = $id";
    } else {
        $sql = "UPDATE tarefas SET status = '$status', descricao= '$descricao', data_entrega= '$data_entrega', id_responsavel= '$id_responsavel' WHERE id= $id";
    }
    var_dump($sql);
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
