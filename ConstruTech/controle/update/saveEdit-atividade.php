<?php
include_once('../conexao-bd.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nome_atividade = $_POST['nome_atividade'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_termino = $_POST['data_termino'];
    $status = $_POST['status'];
    $projeto_id = $_POST['projeto_id'] ?: 'NULL';

    $sqlUpdate = "UPDATE Atividade SET 
        nome_atividade='$nome_atividade',  
        descricao='$descricao',  
        data_inicio='$data_inicio', 
        data_termino='$data_termino', 
        status='$status', 
        projeto_id=$projeto_id
    WHERE id=$id";

    if ($conexao->query($sqlUpdate) === TRUE) {
        header("Location: ../../visao/paginas/pagCronograma-gestor.php");
        exit();
    } else {
        echo "Erro ao atualizar a atividade: " . $conexao->error;
    }
}
?>
