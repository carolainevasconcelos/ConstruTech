<?php
include_once('../conexao-bd.php'); 

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome']; 
    $descricao = $_POST['descricao']; 
    $data_inicio = $_POST['data_inicio']; 
    $data_termino = $_POST['data_termino']; 
    $statu = $_POST['statu']; 
    $cliente_id = $_POST['cliente_id'] ?? null; 

    if (!empty($nome) && !empty($descricao) && !empty($data_inicio) && !empty($data_termino) && !empty($statu)) {
        $stmt = $conexao->prepare("UPDATE Projeto SET 
            nome = ?, descricao = ?, data_inicio = NULLIF(?, ''), 
            data_termino = NULLIF(?, ''), statu = ?, cliente_id = ? 
            WHERE id = ?");
        $stmt->bind_param("sssssii", $nome, $descricao, $data_inicio, $data_termino, $statu, $cliente_id, $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Projeto atualizado com sucesso!');
                    window.location.href = '../../visao/paginas/cadastro.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao atualizar projeto: " . $stmt->error . "');
                    window.location.href = '../../visao/paginas/pagProjeto-adm.php';
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('Erro: Todos os campos obrigatórios devem ser preenchidos.');
                window.location.href = '../../visao/paginas/pagProjeto-adm.php';
              </script>";
    }
} else {
    header("Location: ../../visao/paginas/pagProjeto-adm.php");
}
?>
