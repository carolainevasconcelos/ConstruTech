<?php
    include_once('../conexao-bd.php');

    $nome = '';
    $cpf = '';
    $email = '';
    $telefone = '';
    $endereco = '';

    if (isset($_POST['submit'])) {
        // Coletando os dados diretamente do POST
        $nome = $_POST['nome-pf'];
        $cpf = $_POST['cpf-pf'];
        $email = $_POST['email-pf'];
        $telefone = $_POST['telefone-pf'];
        $endereco = $_POST['endereco-pf'];

        // Validação dos campos obrigatórios
        if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($telefone) && !empty($endereco)) {
            // Inserindo os dados na tabela
            $resultado = mysqli_query($conexao, "INSERT INTO cliente (nome, cpf, email, endereco, telefone) VALUES ('$nome', '$cpf', '$email', '$endereco', '$telefone')");

            if ($resultado) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
            }
        } else {
            echo "<script>alert('Todos os campos devem ser preenchidos.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pessoa Física</title>
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
    <section class="section-pf">
        <div class="form-container" id="div-pf">
            <form action="" method="post">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Cadastrar Cliente</h1>
                </div>

                <div class="input-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome-pf" required>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf-pf" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email-pf" required>
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone-pf" required>
                </div>


                <div class="input-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco-pf" required>
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