<?php
session_start();
// include_once('../conexao-bd.php');

if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('Location: loginPag.php');
}

$logado = $_SESSION['usuario'];

$sql_projeto = "SELECT Atividade.id, Funcionario.nome AS nome_funcionario, Projeto.nome AS nome_projeto, 
                Atividade.nome_atividade, Atividade.descricao, Atividade.data_inicio, 
                Atividade.data_termino, Atividade.status
                FROM Atividade
                JOIN Funcionario ON Atividade.funcionario_id = Funcionario.id
                JOIN Projeto ON Atividade.projeto_id = Projeto.id
                ORDER BY Atividade.id ASC";

$result_projeto = $conexao->query($sql_projeto);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Atividade</title>
    <link rel="stylesheet" href="../../visao/css/styleListas.css">
</head>

<body>
    <h1>Cronograma de Atividades</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Funcionario</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de inicio</th>
                    <th scope="col">Data de termino</th>
                    <th scope="col">Status</th>
                    <th scope="col">Projeto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result_projeto)) {
                    echo "<tr>";
                        echo "<td>" . $user_data['id'] . "</td>";
                        echo "<td>" . $user_data['nome_funcionario'] . "</td>";
                        echo "<td>" . $user_data['nome_atividade'] . "</td>";
                        echo "<td>" . $user_data['descricao'] . "</td>";
                        echo "<td>" . $user_data['data_inicio'] . "</td>";
                        echo "<td>" . $user_data['data_termino'] . "</td>";
                        echo "<td>" . $user_data['status'] . "</td>";
                        echo "<td>" . $user_data['nome_projeto'] . "</td>";
                        echo "<td>
                            <a class='image' href='../../controle/update/edit-atividade.php?id=" . $user_data['id'] . "'>
                                <img src='../../visao/img/image-pencil.png' alt='Editar'>
                            </a>
                        </td>";
                        echo "<td>
                            <a class='image' href='../../controle/delete/delete-atividade.php?id=" . $user_data['id'] . "'>
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