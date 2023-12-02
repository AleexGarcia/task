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

if ($token->nivel == 'cordenador' || $token->nivel == 'admin') {
    $sql = "SELECT * FROM tarefas WHERE id_criador = $id";
} else {
    $sql = "SELECT * FROM tarefas WHERE id_responsavel = $id";
}

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
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>

<body>
    <?php
    require_once('./header.php');
    HeaderComponent($token->nivel,$token->nome);
    ?>
    <main>
        <div class="dashboard-container">
            <h2>Dashboard</h2>
            <div class="top-box">
                <?php
                if ($token->nivel == 'cordenador' || $token->nivel == 'admin') {
                    echo "<h3>Gerenciar tarefas:</h3>";
                    echo "<a href='./tarefa.php'>Criar Tarefa</a>";
                } else {
                    echo "<h3>Suas tarefas</h3>";
                }
                ?>
            </div>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($token->nivel == 'cordenador' || $token->nivel == 'admin') {
                        echo "<div class='tarefa'>";
                        echo "<p><strong>Descrição:</strong> " . $row["descricao"] . "</p>";
                        echo "<p><strong>Data Final de Entrega:</strong> " . $row["data_entrega"] . "</p>";
                        echo "<p><strong>Status:</strong> {$row['status']}</p>";
                        echo "<div>
                            <a href='./actions/tarefas/deletar_tarefa.php?id={$row['id']}'>Excluir</a>
                            <a href='./tarefa.php?id={$row['id']}'>Editar</a>
                        </div>";
                        echo "</div>";
                    } else {
                        echo "<div class='tarefa'>";
                        echo "<p><strong>Descrição:</strong> " . $row["descricao"] . "</p>";
                        echo "<p><strong>Data Final de Entrega:</strong> " . $row["data_entrega"] . "</p>";
                        echo "<form action='confirmar_entrega.php' method='post'>";
                        echo "<input type='hidden' name='id_tarefa' value='" . $row["id"] . "'>";
                        echo "<button type='submit'>Confirmar Entrega</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                }
            } else {
                if ($token->nivel == 'cordenador' || $token->nivel == 'admin') {
                    echo "<p>Nenhuma tarefa criada no momento.</p>";
                } else {
                    echo "<p>Nenhuma tarefa atribuída no momento.</p>";
                }
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Desenvolvido por ...</p>
    </footer>
</body>

</html>