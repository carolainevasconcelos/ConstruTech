<?php
include_once('../conexao-bd.php');

// Inicialização das variáveis
$nome = '';
$cpf = '';
$email = '';
$telefone = '';
$endereco = '';
$data_admissao = '';
$cargo = '';
$setor = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Receber os dados do formulário
    $nome = $_POST['nome-pp'] ?? '';
    $cpf = $_POST['cpf-pp'] ?? '';
    $email = $_POST['email-pp'] ?? '';
    $telefone = $_POST['telefone-pp'] ?? '';
    $endereco = $_POST['endereco-pp'] ?? '';
    $data_admissao = $_POST['data_admissao'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $setor = $_POST['setor'] ?? '';

    // Validar campos obrigatórios
    if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($telefone) && !empty($endereco) && !empty($data_admissao) && !empty($cargo) && !empty($setor)) {
        // Inserir no banco de dados
        $resultado = mysqli_query($conexao, "INSERT INTO funcionario (nome, cpf, email, endereco, telefone, data_admissao, cargo, setor) 
            VALUES ('$nome', '$cpf', '$email', '$endereco', '$telefone', NULLIF('$data_admissao', ''), '$cargo', '$setor')");

        if ($resultado) {
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
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
                <a href="../../visao/paginas/cadastro.php" class="logout">Voltar</a>
                <a href="../sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>
    <section class="section-pp">
        <div class="form-container" id="div-pp">
            <form action="" method="post">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Cadastrar Funcionario</h1>
                </div>
                <div class="input-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome-pp" required>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf-pp" required>
                </div>

                <div class="input-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco-pp" required>
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone-pp" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email-pp" required>
                </div>

                <div class="input-group">
                    <label for="data_admissao">Data de admissão:</label>
                    <input type="date" name="data_admissao" id="data_admissao" required>
                </div>


                <div class="input-group">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" required>
                </div>

                <div class="input-group">
                    <label for="setor">Setor:</label>
                    <select name="setor" id="setor">
                        <option value="">Selecione</option>
                        <option value="administrativo">Administrativo</option>
                        <option value="colaborativo">Colaborativo</option>
                        <option value="gestao">Gestão</option>
                    </select>
                </div>
                <input type="submit" name="submit" value="Cadastrar" id="botao">
        </div>
        </form>
        </div>
    </section>
    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>