<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM projeto WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        
        $sqlDelete = "DELETE FROM projeto  WHERE id=$id";
        
        $resultDelete = $conexao->query($sqlDelete);
        header('Location: ../../visao/paginas/pagProjeto-adm.php');
        exit;
    } else {
        header('Location: ../../visao/paginas/pagProjeto-adm.php');
    }
}
?>