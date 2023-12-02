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
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/form-acesso.css">
    <link rel="stylesheet" href="./assets/css/header.css">

<body>
    <?php
    require_once('./header.php');
    HeaderComponent();
    ?>
    <div class="login-container">
        <h2>Login</h2>
        <form action="./actions/autenticacao/login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p>Não possui uma conta? <a href="./cadastro.php">Faça um cadastro</a>.</p>
    </div>
    <footer>
        <p>Desenvolvido por ...</p>
    </footer>
</body>

</html>