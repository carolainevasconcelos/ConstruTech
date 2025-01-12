<?php
include_once('../conexao-bd.php');

$nome = '';
$nome_fantasia = '';
$cnpj = '';
$email = '';
$telefone = '';
$endereco = '';

if (isset($_POST['submit'])) {
    // Coletando dados diretamente do POST
    $nome = $_POST['nome-pj'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email-pj'];
    $telefone = $_POST['telefone-pj'];
    $endereco = $_POST['endereco-pj'];

    // Validação dos campos obrigatórios
    if (!empty($nome) && !empty($nome_fantasia) && !empty($cnpj) && !empty($email) && !empty($telefone) && !empty($endereco)) {
        $resultado = mysqli_query($conexao, "INSERT INTO cliente (nome, nome_fantasia, cnpj, email, endereco, telefone) VALUES ('$nome', '$nome_fantasia', '$cnpj', '$email', '$endereco', '$telefone')");

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
    <title>Cadastrar Pessoa Juridica</title>
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
    <section class="section-pj">
        <div class="form-container" id="div-pj">

            <form action="" method="post">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Cadastrar Cliente Juridico</h1>
                </div>

                <div class="input-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome-pj" required>
                </div>

                <div class="input-group">
                    <label for="nome-fantasia">Nome Fantasia:</label>
                    <input type="text" id="nome-fantasia" name="nome_fantasia" required>
                </div>

                <div class="input-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" id="cnpj" name="cnpj" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email-pj" required>
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone-pj" required>
                </div>

                <div class="input-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco-pj" required>
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