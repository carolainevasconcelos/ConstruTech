<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM Projeto WHERE id=$id";

    $result_projeto = $conexao->query($sqlSelect);

    // print_r($result_projeto);

    if ($result_projeto->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result_projeto)) {
            $nome = $user_data['nome'];
            $descricao = $user_data['descricao'];
            $data_inicio = $user_data['data_inicio'];
            $data_termino = $user_data['data_termino'];
            $statu = $user_data['statu'] ?? '';
            $cliente_id = $user_data['cliente_id'] ?? null;
        }
    } else {
        header('Location: ../listas/sistema-projeto.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projeto</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body>
    <section class="section-projeto">
        <div class="form-container" id="div-projeto">
            <form action="saveEdit-projeto.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Projeto</h1>
                </div>

                <div class="input-group">
                    <label for="nome">Nome do Projeto:</label>
                    <input type="text" value="<?php echo htmlspecialchars($nome); ?>" id="nome" name="nome" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" value="<?php echo htmlspecialchars($descricao); ?>" id="descricao"
                        name="descricao" required>
                </div>

                <div class="input-group">
                    <label for="data_inicio">Data de Início:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_inicio); ?>" id="data_inicio"
                        name="data_inicio" required>
                </div>

                <div class="input-group">
                    <label for="data_termino">Data de Término:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_termino); ?>" id="data_termino"
                        name="data_termino" required>
                </div>

                <div class="input-group">
                    <label for="statu">Status:</label>
                    <input type="text" value="<?php echo htmlspecialchars($statu); ?>" id="statu" name="statu">
                </div>

                <div class="input-group">
                    <label for="cliente_id">Cliente:</label>
                    <select id="cliente_id" name="cliente_id" required>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Cliente");
                        while ($cliente = mysqli_fetch_assoc($resultado)) {
                            $selected = ($cliente['id'] == $cliente_id) ? 'selected' : '';
                            echo "<option value='{$cliente['id']}' $selected>{$cliente['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>


                <!-- Campo oculto para o ID do projeto -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">


                <input type="submit" name="submit" value="Salvar" id="botao">
            </form>

            <!-- <a href="../listas/sistema-projeto.php">Voltar</a> -->

        </div>
    </section>
</body>

</html>