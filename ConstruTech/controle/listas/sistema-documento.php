<?php
session_start();
include_once('../../controle/conexao-bd.php');

if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('Location: loginPag.php');
}

$logado = $_SESSION['usuario'];

$sql_documentos = "SELECT * FROM Documentos ORDER BY id ASC"; 
$result_documentos = $conexao->query($sql_documentos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="../../visao/css/styleListas.css">
</head>
<body>
    <h1>Documentos</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data Geração</th>
                    <th scope="col">Data Emissão</th>
                    <th scope="col">Arquivo</th>
                    <th scope="col">Projeto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result_documentos)) { 
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['tipo_documento'] . "</td>"; 
                    echo "<td>" . $user_data['descricao'] . "</td>"; 
                    echo "<td>" . $user_data['data_geracao'] . "</td>"; 
                    echo "<td>" . $user_data['data_emissao'] . "</td>"; 
                    echo "<td><a id='downloadArquivo' href='../../visao/img/" . $user_data['arquivo'] . "' download>Baixar Arquivo</a></td>";
                    echo "<td>" . $user_data['projeto_id'] . "</td>"; 
                    echo "<td>
                        <a class='image' href='../../controle/update/edit-documento.php?id=" . $user_data['id'] . "'>
                            <img src='../../visao/img/image-pencil.png' alt='Editar'>
                        </a>
                        <a class='image' href='../../controle/delete/delete-documento.php?id=" . $user_data['id'] . "'>
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
