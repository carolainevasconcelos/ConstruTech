<?php
session_start();
include_once('../conexao-bd.php');

if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {

    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);

    header('Location: loginPag.php');
}

$logado = $_SESSION['usuario'];

$sql_equipamento = "SELECT * FROM equipamento ORDER BY id ASC";

$result_equipamento = $conexao->query($sql_equipamento);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Funcionario</title>
    <link rel="stylesheet" href="../../visao/css/styleListas.css">
    <link rel="stylesheet" href="../../visao/css/style-pagUsuarios.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../../visao/img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="../../visao/paginas/cadastroColab.php">Cadastro</a></li>
                <li><a href="../../visao/paginas/pagCronograma.php">Cronograma</a></li>
                <li><a href="../../visao/pagUsuarios-colab.php">Home</a></li>
                <li><a href="sistema-estoque.php">Estoque</a></li>
                <li><a href="">Equipamentos</a></li>
            </ul>
            <div class="auth-profile">
                <a href="../sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>
    <h1>Acessou o sistema</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descricao</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Projeto</th>
                    <th scope="col">Funcionario</th>
                    <th scope="col">Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result_equipamento)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['tipo']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['descricao']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['quantidade']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['projeto_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['funcionario_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['fornecedor_id']) . "</td>";
                    echo "<td>
                        <a class='image' href='../update/edit-equipamento.php?id=" . $user_data['id'] . "'>
                            <img src='../../visao/img/image-pencil.png' alt='Editar'>
                        </a>
                    </td>";
                    echo "<td>
                        <a class='image' href='../delete/delete-equipamento.php?id=" . $user_data['id'] . "'>
                            <img src='../../visao/img/image-lixeira.png' alt='Deletar'>
                        </a>
                    </td>";
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