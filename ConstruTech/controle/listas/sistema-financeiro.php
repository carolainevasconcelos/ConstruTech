<?php
session_start();
// include_once('../conexao-bd.php');

if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {

    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);

    header('Location: loginPag.php');
}

$logado = $_SESSION['usuario'];

$sql_financeiro = "SELECT * FROM Financeiro ORDER BY id ASC";

$result_financeiro = $conexao->query($sql_financeiro);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Financeiro</title>
    <link rel="stylesheet" href="../../visao/css/styleListas.css">
</head>

<body>
    <h1>Informação Financeiras</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Transação</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Projeto</th>
                    <th scope="col">Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result_financeiro)) {
                    echo "<tr>";
                        echo "<td>" . $user_data['id'] . "</td>";
                        echo "<td>" . $user_data['tipo_transacao'] . "</td>"; 
                        echo "<td>" . number_format($user_data['valor'], 2, ',', '.') . "</td>"; 
                        echo "<td>" . $user_data['descricao'] . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($user_data['data'])) . "</td>"; 
                        echo "<td>" . $user_data['projeto_id'] . "</td>";
                        echo "<td>" . $user_data['fornecedor_id'] . "</td>";
                        echo "<td>
                            <a class='image' href='../../controle/update/edit-financeiro.php?id=" . $user_data['id'] . "'>
                                <img src='../../visao/img/image-pencil.png' alt='Editar'>
                            </a>
                        </td>";
                        echo "<td>
                            <a class='image' href='../../controle/delete/delete-financeiro.php?id=" . $user_data['id'] . "'>
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