<?php
require_once('../../db/conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Consulta para verificar as credenciais no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
    // Verifica se há algum resultado

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Inicia a sessão e redireciona para o dashboard
        session_start();

        $token = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'nivel' => $usuario['nivel']
        ];


        $_SESSION["token"] = json_encode($token);

        header("Location: ../../dashboard.php");
        exit;
    } else {
        // Exibe uma mensagem de erro se as credenciais forem inválidas
        header("Location: ../../index.php?erro=Credenciais inválidas. Tente novamente.");
        exit;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
