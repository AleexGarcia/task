<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Verifique se o usuário está autenticado; redirecione para a página de login se não estiver
if (isset($_SESSION["token"])) {
    header("Location: ./dashboard.php");
    exit();
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./assets/css/form-acesso.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
    <?php
    require_once('./header.php');
    HeaderComponent();
    ?>
    <main>
        <div class="cadastro-container">
            <h2>Cadastro</h2>
            <form action="./actions/usuarios/criar_usuario.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <button type="submit">Cadastrar</button>
            </form>
            <p>Já possui uma conta? <a href="index.php">Faça login</a>.</p>
        </div>
    </main>
    <footer>
        <p>Desenvolvido por ...</p>
    </footer>
</body>

</html>