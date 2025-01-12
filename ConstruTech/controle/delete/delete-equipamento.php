<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM equipamento WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        
        $sqlDelete = "DELETE FROM equipamento  WHERE id=$id";
        
        $resultDelete = $conexao->query($sqlDelete);

        header('Location: ../listas/sistema-equipamento.php');
        exit;
    } else {
        header('Location: ../listas/sistema-equipamento.php');
    }
}
?>