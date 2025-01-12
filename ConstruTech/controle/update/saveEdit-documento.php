<?php
include_once('../conexao-bd.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $tipo_documento = $_POST['tipo_documento']; 
    $descricao = $_POST['descricao']; 
    $data_geracao = $_POST['data_geracao']; 
    $data_emissao = $_POST['data_emissao']; 
    $projeto_id = $_POST['projeto_id'] ?? null; 

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        $caminho_arquivo = '../../uploads/' . basename($_FILES['arquivo']['name']);
        
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
            $arquivo = $_FILES['arquivo']['name'];
        } else {
            $arquivo = null; 
        }
    } else {
        $sqlSelect = "SELECT arquivo FROM documentos WHERE id=$id";
        $result_documento = $conexao->query($sqlSelect);
        if ($result_documento->num_rows > 0) {
            $user_data = mysqli_fetch_assoc($result_documento);
            $arquivo = $user_data['arquivo']; 
        }
    }

    $sqlUpdate = "UPDATE documentos SET 
        tipo_documento='$tipo_documento',  
        descricao='$descricao',  
        data_geracao='$data_geracao',  
        data_emissao='$data_emissao', 
        arquivo='$arquivo', 
        projeto_id=" . ($projeto_id !== null ? "'$projeto_id'" : 'NULL') . " 
    WHERE id=$id";

    if ($conexao->query($sqlUpdate) === TRUE) { 
        echo "Atualização realizada com sucesso.";
        header("Location: ../../visao/paginas/pagDoc-adm.php"); 
        exit();
    } else {
        echo "Erro ao atualizar o documento: " . $conexao->error;
    }
}
?>
