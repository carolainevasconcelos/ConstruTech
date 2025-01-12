<?php
session_start();
include('../../controle/conexao-bd.php');

// Verificar se a sessão está ativa e o usuário está logado
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('Location: ../loginPag.php');
    exit;
}

$usuario_id = $_SESSION['usuario']; // ID do usuário logado

// Verificar se o ID do usuário foi recuperado corretamente
// echo "ID do Usuário: " . $usuario_id; // Pode ser removido após verificar

// Consulta SQL para obter os dados financeiros
$sql_projeto = "SELECT * FROM Financeiro WHERE id = '$usuario_id' ORDER BY id ASC";
$result_projeto = mysqli_query($conexao, $sql_projeto);

// Verificar se a consulta retornou resultados
if (!$result_projeto) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro - Cliente</title>
    <link rel="stylesheet" href="../css/stylePaginas.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="pagProjeto.php">Projetos</a></li>
                <li><a href="../pagUsuarios-cliente.php">Home</a></li>
                <li><a href="pagFinanceiro.php">Financeiro</a></li>
                <li><a href="atendimento.php">Atendimento</a></li>
            </ul>
            <div class="auth-profile">
                <a href="../../controle/sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Valor do pagamento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">ID do Projeto</th>
                    <th scope="col">ID do Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Laço para exibir os dados financeiros
                while ($user_data = mysqli_fetch_assoc($result_projeto)) {
                    echo "<tr>";
                    echo "<td>" . number_format($user_data['valor'], 2, ',', '.') . "</td>";
                    echo "<td>" . $user_data['descricao'] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($user_data['data'])) . "</td>";
                    echo "<td>" . $user_data['projeto_id'] . "</td>";
                    echo "<td>" . $user_data['fornecedor_id'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>
