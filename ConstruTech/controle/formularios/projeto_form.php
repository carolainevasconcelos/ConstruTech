<?php
include_once('../conexao-bd.php');

$nome = '';
$descricao = '';
$data_inicio = '';
$data_termino = '';
$statu = '';
$cliente_id = null;

if (isset($_POST['submit'])) {
    $nome = $_POST['nome-projeto'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_termino = $_POST['data_termino'] ?? '';
    $statu = $_POST['statu'] ?? '';
    $cliente_id = $_POST['cliente_id'] ?? null;

    if (!empty($statu) && !empty($cliente_id) && !empty($nome)) {
        $query = "INSERT INTO Projeto (nome, descricao, data_inicio, data_termino, statu, cliente_id) 
                  VALUES ('$nome', '$descricao', NULLIF('$data_inicio', ''), NULLIF('$data_termino', ''), '$statu', $cliente_id)";
        $resultado = mysqli_query($conexao, $query);

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
    <title>Cadastro de Projeto</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
    <link rel="stylesheet" href="../../visao/css/style-pagUsuarios.css">
    <link rel="stylesheet" href="../../visao/css/style-cadastro.css">
    <script src="../../visao/js/validarCampos.js" defer></script>
</head>

<body>
<header>
        <nav>
            <div class="logo">
                <img src="../../visao/img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <!-- <ul>
                <li><a href="paginas/pagClientes-adm.php">Clientes</a></li>
                <li><a href="paginas/pagProjeto-adm.php">Projetos</a></li>
                <li><a href="paginas/pagFuncionario.php">Funcionário</a></li>
                <li><a href="">Home</a></li>
                <li><a href="paginas/pagDoc-adm.php">Documentos</a></li>
                <li><a href="paginas/pagFinanceiro-adm.php">Financeiro</a></li>
                <li><a href="paginas/pagFornecedor-adm.php">Fornecedores</a></li>
                <li><a href="paginas/cadastro.php">Cadastro</a></li>
            </ul> -->
            <div class="auth-profile">
                <a href="../../visao/paginas/cadastro-gestor.php" class="logout">Voltar</a>
                <a href="../sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>
    <section class="section-projeto">
        <div class="form-container" id="div-projeto">
            <form action="" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h2>Cadastrar Projeto</h2>
                </div>
                <div class="input-group">
                    <label for="cliente_id">Cliente:</label>
                    <select id="cliente_id" name="cliente_id" required>
                        <option value="">Selecione</option>
                        <?php
                        include_once('../conexao-bd.php');
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Cliente");
                        while ($cliente = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$cliente['id']}'>{$cliente['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="nome-projeto">Nome do Projeto:</label>
                    <input type="text" id="nome-projeto" name="nome-projeto" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea>
                </div>

                <div class="input-group">
                    <label for="data_inicio">Data de Início:</label>
                    <input type="date" id="data_inicio" name="data_inicio">
                </div>

                <div class="input-group">
                    <label for="data_termino">Data de Término:</label>
                    <input type="date" id="data_termino" name="data_termino">
                </div>

                <div class="input-group">
                    <label for="statu">Status:</label>
                    <select id="statu" name="statu" required>
                        <option value="">Selecione</option>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
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