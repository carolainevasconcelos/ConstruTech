<?php
include_once('../conexao-bd.php');

$tipo = '';
$descricao = '';
$qtd = '';
$projeto_id = null;
$funcionario_id = null;
$fornecedor_id = null;

// Verifica se é uma edição
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera os dados do equipamento a ser editado
    $sqlSelect = "SELECT * FROM equipamento WHERE id=$id";
    $result_equipamento = $conexao->query($sqlSelect);

    if ($result_equipamento->num_rows > 0) {
        $equipamento = mysqli_fetch_assoc($result_equipamento);
        $tipo = $equipamento['tipo'];
        $descricao = $equipamento['descricao'];
        $qtd = $equipamento['quantidade'];
        $projeto_id = $equipamento['projeto_id'];
        $funcionario_id = $equipamento['funcionario_id'];
        $fornecedor_id = $equipamento['fornecedor_id'];
    } else {
        header('Location: ../listas/sistema-equipamentos.php');
    }
}

// Salva os dados, seja inserção ou edição
if (isset($_POST['submit'])) {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $qtd = $_POST['quantidade'];
    $projeto_id = $_POST['projeto_id'];
    $funcionario_id = $_POST['funcionario_id'];
    $fornecedor_id = $_POST['fornecedor_id'];

    if (!empty($_POST['id'])) {
        // Atualiza os dados existentes
        $id = $_POST['id'];
        $sqlUpdate = "UPDATE equipamento SET tipo='$tipo', descricao='$descricao', quantidade='$qtd', projeto_id='$projeto_id', funcionario_id='$funcionario_id', fornecedor_id='$fornecedor_id' WHERE id=$id";
        $resultado = mysqli_query($conexao, $sqlUpdate);

        if ($resultado) {
            echo "<script>alert('Edição realizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao editar: " . mysqli_error($conexao) . "');</script>";
        }
    } else {
        // Insere novos dados
        $sqlInsert = "INSERT INTO equipamento (tipo, descricao, quantidade, projeto_id, funcionario_id, fornecedor_id) VALUES ('$tipo', '$descricao', '$qtd', '$projeto_id', '$funcionario_id', '$fornecedor_id')";
        $resultado = mysqli_query($conexao, $sqlInsert);

        if ($resultado) {
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Equipamento</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
    <link rel="stylesheet" href="../../visao/css/style-pagUsuarios.css">
</head>

<body>
    <section class="section-equipamento">
        <div class="form-container" id="div-equipamento">
            <form action="saveEdit-equipamento.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h2><?php echo !empty($_GET['id']) ? 'Editar' : 'Cadastro'; ?> de Equipamento</h2>
                </div>
                <div class="input-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea>
                </div>

                <div class="input-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($qtd); ?>" required>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            $selected = ($projeto_id == $projeto['id']) ? 'selected' : '';
                            echo "<option value='{$projeto['id']}' $selected>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="funcionario_id">Funcionario:</label>
                    <select id="funcionario_id" name="funcionario_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Funcionario WHERE setor = 'colaborativo'");
                        while ($funcionario = mysqli_fetch_assoc($resultado)) {
                            $selected = ($funcionario_id == $funcionario['id']) ? 'selected' : '';
                            echo "<option value='{$funcionario['id']}' $selected>{$funcionario['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="fornecedor_id">Fornecedor:</label>
                    <select id="fornecedor_id" name="fornecedor_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM fornecedor");
                        while ($fornecedor = mysqli_fetch_assoc($resultado)) {
                            $selected = ($fornecedor_id == $fornecedor['id']) ? 'selected' : '';
                            echo "<option value='{$fornecedor['id']}' $selected>{$fornecedor['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo !empty($_GET['id']) ? htmlspecialchars($id) : ''; ?>">
                <input type="submit" name="update" value="Salvar" id="botao">
                </form>
            </form>
        </div>
    </section>
</body>

</html>
