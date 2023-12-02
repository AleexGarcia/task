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
$token = json_decode($_SESSION["token"]);
$id = $token->id;

$sql = "SELECT * FROM tarefas WHERE id_responsavel = $id";
$result = $conn->query($sql);

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
    <?php
    require_once('./header.php');
    HeaderComponent($token->nivel);
    ?>
    <main>
        <div class="dashboard-container">
            <h2>Dashboard</h2>
            <p>Bem-vindo, <?php echo $token->nome; ?>!</p>
            <h3>Suas Tarefas:</h3>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='tarefa'>";
                    echo "<p><strong>Descrição:</strong> " . $row["descricao"] . "</p>";
                    echo "<p><strong>Data Final de Entrega:</strong> " . $row["data_entrega"] . "</p>";
                    echo "<form action='confirmar_entrega.php' method='post'>";
                    echo "<input type='hidden' name='id_tarefa' value='" . $row["id"] . "'>";
                    echo "<button type='submit'>Confirmar Entrega</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma tarefa atribuída no momento.</p>";
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Desenvolvido por ...</p>
    </footer>
</body>

</html>