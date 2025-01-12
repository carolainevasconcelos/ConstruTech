<?php
include_once('../conexao-bd.php');

$tipo = '';
$descricao = '';
$qtd = '';
$projeto_id = null;
$funcionario_id = null;
$fornecedor_id = null;

if (isset($_POST['submit'])) {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $qtd = $_POST['quantidade'];
    $projeto_id = $_POST['projeto_id'];
    $funcionario_id = $_POST['funcionario_id'];
    $fornecedor_id = $_POST['fornecedor_id'];

    $resultado = mysqli_query($conexao, "INSERT INTO equipamento (tipo, descricao, quantidade, projeto_id, funcionario_id, fornecedor_id) VALUES ('$tipo', '$descricao', '$qtd', '$projeto_id', '$funcionario_id', '$fornecedor_id')");

    if ($resultado) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
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
    <script src="../../visao/js/validarCampos.js" defer></script>
</head>

<body>
<header>
        <nav>
            <div class="logo">
                <img src="../../visao/img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            
            <div class="auth-profile">
                <a href="../../visao/paginas/cadastroColab.php" class="logout">Voltar</a>
                <a href="../sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>
    <section class="section-equipamento">
        <div class="form-container" id="div-equipamento">
            <form action="" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h2>Cadastro de Equipamento</h2>
                </div>
                <div class="input-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required></textarea>
                </div>

                <div class="input-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" id="quantidade" name="quantidade" required>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        include_once('../conexao-bd.php');
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$projeto['id']}'>{$projeto['nome']}</option>";
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
                            echo "<option value='{$funcionario['id']}'>{$funcionario['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="fornecedor_id">Fornecedor:</label>
                    <select id="fornecedor_id" name="fornecedor_id" required>
                        <option value="">Selecione</option>
                        <?php
                        include_once('../conexao-bd.php');
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM fornecedor");
                        while ($fornecedor = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$fornecedor['id']}'>{$fornecedor['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" name="submit" value="Cadastrar" id="botao">
            </form>
        </div>
    </section>
    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>