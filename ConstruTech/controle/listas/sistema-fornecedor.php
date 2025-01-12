<?php
session_start();
// include_once('../conexao-bd.php');

if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {

    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);

    header('Location: loginPag.php');
}

$logado = $_SESSION['usuario'];

$sql_fornecedor = "SELECT * FROM Fornecedor ORDER BY id ASC";

$result_fornecedor = $conexao->query($sql_fornecedor);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Funcionario</title>
    <link rel="stylesheet" href="../../visao/css/styleListas.css">
</head>

<body>
    <h1>Lista de Fornecedores</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Endereco</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result_fornecedor)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['nome_fantasia']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['cnpj']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['telefone']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['endereco']) . "</td>";
                    echo "<td>
                        <a class='image' href='../../controle/update/edit-fornecedor.php?id=" . $user_data['id'] . "'>
                            <img src='../../visao/img/image-pencil.png' alt='Editar'>
                        </a>
                    </td>";
                        echo "<td>
                        <a class='image' href='../../controle/delete/delete-fornecedor.php?id=" . $user_data['id'] . "'>
                            <img src='../../visao/img/image-lixeira.png' alt='Deletar'>
                        </a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>