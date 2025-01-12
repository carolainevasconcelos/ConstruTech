<?php
include_once('../conexao-bd.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $projeto_id = !empty($_POST['projeto_id']) ? $_POST['projeto_id'] : NULL;
    $funcionario_id = !empty($_POST['funcionario_id']) ? $_POST['funcionario_id'] : NULL;
    $fornecedor_id = !empty($_POST['fornecedor_id']) ? $_POST['fornecedor_id'] : NULL;

    // Usando prepared statements para evitar SQL Injection
    $sqlUpdate = "UPDATE equipamento SET 
        tipo = ?, 
        descricao = ?, 
        quantidade = ?, 
        projeto_id = ?, 
        funcionario_id = ?, 
        fornecedor_id = ? 
        WHERE id = ?";

    // Prepara a consulta
    if ($stmt = $conexao->prepare($sqlUpdate)) {
        // Vincula os parâmetros (types: s = string, i = integer)
        $stmt->bind_param("ssiiiii", $tipo, $descricao, $quantidade, $projeto_id, $funcionario_id, $fornecedor_id, $id);

        // Executa a consulta
        if ($stmt->execute()) {
            header("Location: ../listas/sistema-equipamento.php");
        } else {
            echo "Erro ao atualizar o registro: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conexao->error;
    }
} else {
    header("Location: ../listas/sistema-equipamento.php");
}
?>
