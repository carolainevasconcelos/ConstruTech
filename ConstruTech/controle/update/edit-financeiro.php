<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    // Corrigido: A consulta SELECT foi adaptada para a sintaxe padrão
    $sqlSelect = "SELECT * FROM Financeiro WHERE id = $id";
    $result_financeiro = $conexao->query($sqlSelect);

    if ($result_financeiro->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result_financeiro);
        $transacao = $user_data['tipo_transacao'] ?? ''; // Corrigido para garantir que o valor está sendo capturado
        $valor = $user_data['valor'];
        $data = $user_data['data'];
        $descricao = $user_data['descricao'];
        $projeto_id = $user_data['projeto_id'] ?? null;
        $fornecedor_id = $user_data['fornecedor_id'] ?? null;
    } else {
        header('Location: ../listas/sistema-financeiro.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Transação</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body onload="toggleFields()">
    <section class="section-financeiro">
        <div class="form-container" id="div-financeiro">
            <form action="saveEdit-financeiro.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Financeiro</h1>
                </div>

                <div class="input-group">
                    <label for="tipo_transacao">Tipo de Transação:</label>
                    <select id="tipo_transacao" name="tipo_transacao" required onchange="toggleFields()">
                        <option value="receita" <?php echo ($transacao === 'receita') ? 'selected' : ''; ?>>Receita</option>
                        <option value="despesa" <?php echo ($transacao === 'despesa') ? 'selected' : ''; ?>>Despesa</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" step="0.01" value="<?php echo htmlspecialchars($valor); ?>" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" value="<?php echo htmlspecialchars($descricao); ?>" id="descricao" name="descricao" required>
                </div>

                <div class="input-group">
                    <label for="data">Data:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data); ?>" id="data" name="data" required>
                </div>

                <div id="projeto_field" style="display: <?php echo ($transacao === 'receita') ? 'block' : 'none'; ?>;">
                    <div class="input-group">
                        <label for="projeto_id">Projeto:</label>
                        <select id="projeto_id" name="projeto_id">
                            <?php
                            $resultado = mysqli_query($conexao, "SELECT id, nome FROM Projeto");
                            while ($projeto = mysqli_fetch_assoc($resultado)) {
                                $selected = ($projeto_id == $projeto['id']) ? 'selected' : '';
                                echo "<option value='{$projeto['id']}' $selected>{$projeto['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div id="fornecedor_field" style="display: <?php echo ($transacao === 'despesa') ? 'block' : 'none'; ?>;">
                    <div class="input-group">
                        <label for="fornecedor_id">Fornecedor:</label>
                        <select id="fornecedor_id" name="fornecedor_id">
                            <?php
                            $resultado = mysqli_query($conexao, "SELECT id, nome FROM Fornecedor");
                            while ($fornecedor = mysqli_fetch_assoc($resultado)) {
                                $selected = ($fornecedor_id == $fornecedor['id']) ? 'selected' : '';
                                echo "<option value='{$fornecedor['id']}' $selected>{$fornecedor['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <input type="submit" name="submit" value="Salvar" id="botao">
            </form>

            <script>
                function toggleFields() {
                    const tipoTransacao = document.getElementById('tipo_transacao').value;
                    const projetoField = document.getElementById('projeto_field');
                    const fornecedorField = document.getElementById('fornecedor_field');

                    if (tipoTransacao === 'receita') {
                        projetoField.style.display = 'block';
                        fornecedorField.style.display = 'none';
                    } else if (tipoTransacao === 'despesa') {
                        projetoField.style.display = 'none';
                        fornecedorField.style.display = 'block';
                    } else {
                        projetoField.style.display = 'none';
                        fornecedorField.style.display = 'none';
                    }
                }
            </script>
        </div>
    </section>
</body>

</html>
