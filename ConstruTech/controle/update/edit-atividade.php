<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM Atividade WHERE id=$id";
    $result_atividade = $conexao->query($sqlSelect);

    if ($result_atividade->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result_atividade);
        $nome_atividade = $user_data['nome_atividade'];
        $descricao = $user_data['descricao'];
        $data_inicio = $user_data['data_inicio'];
        $data_termino = $user_data['data_termino'];
        $status = $user_data['status'];
        $funcionario_id = $user_data['funcionario_id'];
        $projeto_id = $user_data['projeto_id'];
    } else {
        header('Location: ../listas/sistema-atividade.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Atividade</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body>
    <section class="section-atividade">
        <div class="form-container">
            <form action="saveEdit-atividade.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Atividade</h1>
                </div>

                <div class="input-group">
                    <label for="funcionario_id">Funcionario:</label>
                    <select id="funcionario_id" name="funcionario_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Funcionario WHERE setor = 'colaborativo'");
                        while ($funcionario = mysqli_fetch_assoc($resultado)) {
                            $selected = $funcionario['id'] == $funcionario_id ? 'selected' : '';
                            echo "<option value='{$funcionario['id']}' $selected>{$funcionario['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            $selected = $projeto['id'] == $projeto_id ? 'selected' : '';
                            echo "<option value='{$projeto['id']}' $selected>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="nome_atividade">Nome da Atividade:</label>
                    <input type="text" value="<?php echo htmlspecialchars($nome_atividade); ?>" id="nome_atividade" name="nome_atividade" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea>
                </div>

                <div class="input-group">
                    <label for="data_inicio">Data de Início:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_inicio); ?>" id="data_inicio" name="data_inicio" required>
                </div>

                <div class="input-group">
                    <label for="data_termino">Data de Término:</label>
                    <input type="date" value="<?php echo htmlspecialchars($data_termino); ?>" id="data_termino" name="data_termino" required>
                </div>

                <div class="input-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pendente" <?php echo $status == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                        <option value="em andamento" <?php echo $status == 'em andamento' ? 'selected' : ''; ?>>Em Andamento</option>
                        <option value="concluido" <?php echo $status == 'concluido' ? 'selected' : ''; ?>>Concluído</option>
                        <option value="cancelado" <?php echo $status == 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                        <option value="atrasado" <?php echo $status == 'atrasado' ? 'selected' : ''; ?>>Atrasado</option>
                        <option value="em espera" <?php echo $status == 'em espera' ? 'selected' : ''; ?>>Em Espera</option>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="submit" name="submit" value="Salvar" id="botao">
            </form>
        </div>
    </section>
</body>

</html>
