<?php
include_once('../conexao-bd.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sqlUpdate = "UPDATE fornecedor SET 
        nome='$nome',  
        nome_fantasia='$nome_fantasia',  
        cnpj='$cnpj',  
        email='$email', 
        telefone='$telefone', 
        endereco='$endereco' 
    WHERE id=$id";

    if ($conexao->query($sqlUpdate) === TRUE) {
        echo "Atualização realizada com sucesso.";
        header("Location: ../../visao/paginas/pagFornecedor-adm.php");
        exit();
    } else {
        echo "Erro ao atualizar o fornecedor: " . $conexao->error;
    }
}
?>