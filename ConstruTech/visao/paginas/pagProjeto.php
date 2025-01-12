<?php
// Inclua a conexão com o banco de dados
include('../../controle/conexao-bd.php');

// Consulta para pegar os dados dos projetos
$query_projeto = "SELECT * FROM Projeto";  // Ajuste o nome da tabela conforme necessário

// Executar a consulta
$result_projeto = mysqli_query($conexao, $query_projeto);

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
    <title>Document</title>
    <link rel="stylesheet" href="../css/style-pagUsuarios.css">
    <link rel="stylesheet" href="../css/styleListas.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="">Projetos</a></li>
                <!-- <li><a href="pagFinanceiro.php">Financeiro</a></li> -->
                <li><a href="../pagUsuarios-cliente.php">Home</a></li>
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
                    <th scope="col">Nome do Projeto</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de Início</th>
                    <th scope="col">Data de Término</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Preenche a tabela com os dados dos projetos
                    while ($user_data = mysqli_fetch_assoc($result_projeto)) {
                        echo "<tr>";
                            echo "<td>" . $user_data['nome'] . "</td>";
                            echo "<td>" . $user_data['descricao'] . "</td>";
                            echo "<td>" . $user_data['data_inicio'] . "</td>";
                            echo "<td>" . $user_data['data_termino'] . "</td>";
                            echo "<td>" . $user_data['statu'] . "</td>";
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
