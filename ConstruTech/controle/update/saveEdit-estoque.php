<?php
include_once('../conexao-bd.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $produto = $_POST['produto'];
    $qtd = $_POST['quantidade_total'];
    $movimentacao = $_POST['tipo_movimentacao'];
    $data = $_POST['data_movimentacao'];
   
    // Verificando se financeiro_id e projeto_id são vazios e definindo como NULL
    $financeiro_id = !empty($_POST['financeiro_id']) ? $_POST['financeiro_id'] : NULL;
    $projeto_id = !empty($_POST['projeto_id']) ? $_POST['projeto_id'] : NULL;

    // Usando prepared statements para evitar SQL Injection
    $sqlUpdate = "UPDATE estoque SET
        produto = ?,  
        quantidade_total = ?,  
        tipo_movimentacao = ?,  
        data_movimentacao = ?, 
        projeto_id = ?, 
        financeiro_id = ? 
        WHERE id = ?";

    // Prepara a consulta
    if ($stmt = $conexao->prepare($sqlUpdate)) {
        // Vincula os parâmetros (types: s = string, i = integer)
        $stmt->bind_param("sissiii", $produto, $qtd, $movimentacao, $data, $projeto_id, $financeiro_id, $id);
        
        // Executa a consulta
        if ($stmt->execute()) {
            header("Location: ../listas/sistema-estoque.php");
        } else {
            echo "Erro ao atualizar o registro: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conexao->error;
    }
} else {
    header("Location: ../listas/sistema-estoque.php");
}
?>
