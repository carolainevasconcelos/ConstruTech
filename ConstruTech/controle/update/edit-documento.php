<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM Documentos WHERE id=$id";
    $result_documentos = $conexao->query($sqlSelect);

    if ($result_documentos->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result_documentos)) {
            $tipo_documento = $user_data['tipo_documento'];
            $descricao = $user_data['descricao'];
            $data_geracao = $user_data['data_geracao'];
            $data_emissao = $user_data['data_emissao'];
            $arquivo = $user_data['arquivo'];
            $projeto_id = $user_data['projeto_id'] ?? null;
        }
    } else {
        header('Location: ../listas/sistema-documentos.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Documento</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body>
    <section class="section-documento">
        <div class="form-container" id="div-documento">
            <form action="saveEdit-documento.php" method="POST" enctype="multipart/form-data">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Documentos</h1>
                </div>

                <div class="input-group">
                    <label for="tipo_documento">Tipo de Documento:</label>
                    <input type="text" value="<?php echo htmlspecialchars($tipo_documento); ?>" id="tipo_documento" name="tipo_documento" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" value="<?php echo htmlspecialchars($descricao); ?>" id="descricao" name="descricao" required>
                </div>

                <div class="input-group">
                    <label for="data_geracao">Data de Geração:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_geracao); ?>" id="data_geracao" name="data_geracao" required>
                </div>

                <div class="input-group">
                    <label for="data_emissao">Data de Emissão:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_emissao); ?>" id="data_emissao" name="data_emissao" required>
                </div>

                <div class="input-group">
                    <label for="arquivo">Escolher Novo Arquivo (opcional):</label>
                    <input type="file" id="arquivo" name="arquivo">
                    <p>Arquivo Atual: <?php echo htmlspecialchars($arquivo); ?></p>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        // Consulta os projetos disponíveis
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            $selected = ($projeto_id == $projeto['id']) ? 'selected' : '';
                            echo "<option value='{$projeto['id']}' $selected>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <input type="submit" name="submit" value="Salvar" id="botao">
            </form>
        </div>
    </section>
</body>

</html>
