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


$token = json_decode($_SESSION["token"]);;


require_once('./db/conexao.php');
$sql = "SELECT * FROM usuarios WHERE nivel = 'padrao'";
$resultsUser = $conn->query($sql);
$resultsTarefa = null;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM tarefas WHERE id = $id";
    $resultsTarefa = $conn->query($sql);
    $resultsTarefa = $resultsTarefa->fetch_assoc();
}


$conn->close();


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/form-acesso.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>

<body>
    <?php
    require_once('./header.php');
    HeaderComponent($token->nivel, $token->nome);
    ?>
    <main>
        <a href="./dashboard.php">Voltar</a>
        <div class="cadastro-tarefa-container">
            <?php
            echo !isset($_GET['id']) ? "<h2>Cadastrar tarefa</h2>" : "<h2>Editar tarefa</h2>";
            $action = !isset($_GET['id']) ? 'criar_tarefa.php' : 'atualizar_tarefa.php'
            ?>
            <form action="<?php echo "./actions/tarefas/$action" ?>" method="post">

                <input hidden value="<?php echo isset($_GET['id']) ? $resultsTarefa['id'] : ''; ?>" type="text" name="id" required>
                <input hidden value="<?php echo isset($_GET['id']) ? $resultsTarefa['status'] : ''; ?>" type="text" name="status" required>
                <input hidden type="number" name="id_criador" value="<?php echo $token->id; ?>">


                <label for="descricao">Descrição:</label>
                <input value="<?php echo isset($_GET['id']) ? $resultsTarefa['descricao'] : ''; ?>" type="text" name="descricao" required>

                <label for="data_entrega">Data de Entrega:</label>
                <input value="<?php echo isset($_GET['id']) ? $resultsTarefa['data_entrega'] : '';  ?>" type="date" name="data_entrega" required>

                <label for="id_responsavel">Responsável:</label>
                <select name="id_responsavel" id="">
                    <?php
                    if ($resultsUser->num_rows > 0) {
                        while ($row = $resultsUser->fetch_assoc()) {
                            if ($row['id'] == $resultsTarefa['id']) {
                                echo "<option selected value='{$row['id']}'>{$row['nome']}</option>";
                            } else {
                                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                            }
                        }
                    }
                    ?>
                </select>
                <?php
                echo !isset($_GET['id']) ? "<button type='submit'>Criar Tarefa</button>" : "<button type='submit'>Salvar Tarefa</button>";
                ?>

            </form>
        </div>
    </main>

    <footer>
        <p>Desenvolvido por ...</p>
    </footer>


</body>

</html>