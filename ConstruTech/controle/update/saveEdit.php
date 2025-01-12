<?php
include_once('../conexao-bd.php'); 

if (isset($_POST['submit'])) { //update para submit
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cpf = $_POST['cpf'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Consulta SQL para atualizar os dados do cliente
    $sqlUpdate = "UPDATE cliente SET 
                    nome = '$nome',
                    nome_fantasia = '$nome_fantasia',
                    cpf = '$cpf',
                    cnpj = '$cnpj',
                    email = '$email',
                    telefone = '$telefone',
                    endereco = '$endereco'
                  WHERE id = $id";
//novo
    if ($conexao->query($sqlUpdate) === TRUE) { 
        echo "Atualização realizada com sucesso.";
        header("Location: ../../visao/paginas/pagClientes-adm.php"); // Redireciona para a lista de clientes
        exit();
    } else {
        echo "Erro ao atualizar o cliente: " . $conexao->error;
    }
}
?>