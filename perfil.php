<!DOCTYPE html>
<html lang="en">

<?php
// Inicie a sessão (certifique-se de que esta linha esteja presente em todas as páginas que usam sessão)
session_start();

// Verifique se o usuário está autenticado; redirecione para a página de login se não estiver
if (!isset($_SESSION["token"])) {
    header("Location: ./login.php");
    exit();
}

// Conexão com o banco de dados 

require_once("./db/conexao.php");

// Consulta para obter as tarefas atribuídas ao usuário
$token = json_decode($_SESSION["token"]);;

$sql = "SELECT * FROM usuarios WHERE id = $token->id";
$results = $conn->query($sql);
$userDetails = $results->fetch_assoc();
// Fecha a conexão com o banco de dados
$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/perfil.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <title>Perfil</title>
</head>

<body>
    <?php
    require_once('./header.php');
    HeaderComponent($token->nivel,$token->nome);
    ?>
    <main>
        <div class="container">
            <h2>Editar perfil</h2>
            <form action="process_edit_user.php" method="post">
                <input type="hidden" name="id" value="<?php echo $userDetails['id']; ?>">
    
                <label for="nome">Name:</label>
                <input type="text" name="nome" value="<?php echo $userDetails['nome']; ?>" required>
                <br>
    
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $userDetails['email']; ?>" required>
                <br>
    
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <br>
    
                <?php if ($token->nivel == 'admin') { ?>
                    <label for="nivel">Nivel de acesso:</label>
                    <select name="nivel">
                        <option value="padrao" <?php echo ($userDetails['nivel'] == 'padrao') ? 'selected' : ''; ?>>Padrão</option>
                        <option value="coordenador" <?php echo ($userDetails['nivel'] == 'coordenador') ? 'selected' : ''; ?>>Coordenador</option>
                        <option value="admin" <?php echo ($userDetails['nivel'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    <br>
                <?php } ?>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Desenvolvido por ...</p>
    </footer>
</body>

</html>