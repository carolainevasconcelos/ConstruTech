<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM Estoque WHERE id=$id";

    $result_estoque = $conexao->query($sqlSelect);

    if ($result_estoque->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result_estoque)) {
            $produto = $user_data['produto'];
            $qtd = $user_data['quantidade_total'];
            $movimentacao = $user_data['tipo_movimentacao'];
            $data = $user_data['data_movimentacao'];
            $projeto_id = $user_data['projeto_id'];
        }
    } else {
        header('Location: ../listas/sistema-estoque.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estoque</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body>
    <section class="section-estoque">
        <div class="form-container" id="div-estoque">
            <form action="saveEdit-estoque.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Estoque</h1>
                </div>
                <div class="input-group">
                    <label for="produto">Nome do Produto:</label>
                    <input type="text" id="produto" name="produto" value="<?php echo htmlspecialchars($produto); ?>" required>
                </div>

                <div class="input-group">
                    <label for="quantidade_total">Quantidade Total:</label>
                    <input type="number" id="quantidade_total" name="quantidade_total" value="<?php echo htmlspecialchars($qtd); ?>" required>
                </div>

                <div class="input-group">
                    <label for="tipo_movimentacao">Tipo de Movimentação:</label>
                    <input type="text" id="tipo_movimentacao" name="tipo_movimentacao" value="<?php echo htmlspecialchars($movimentacao); ?>" required>
                </div>

                <div class="input-group">
                    <label for="data_movimentacao">Data de Movimentação:</label>
                    <input type="date" id="data_movimentacao" name="data_movimentacao" value="<?php echo htmlspecialchars($data); ?>" required>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select name="projeto_id" id="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            $selected = ($projeto['id'] == $projeto_id) ? 'selected' : '';
                            echo "<option value='{$projeto['id']}' {$selected}>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <input type="submit" name="update" value="Salvar" id="botao">
            </form>
        </div>
    </section>
</body>

</html>
