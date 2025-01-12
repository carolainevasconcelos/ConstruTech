<?php
include_once('../conexao-bd.php');

$transacao = '';
$valor = '';
$data = '';
$descricao = '';
$projeto_id = null;
$fornecedor_id = null;

if (isset($_POST['submit'])) {
    $transacao = $_POST['tipo_transacao'] ?? '';
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $projeto_id = $_POST['projeto_id'] ?? null;
    $fornecedor_id = $_POST['fornecedor_id'] ?? null;

    // Verifica o tipo de transação
    if ($transacao === 'receita') {
        $fornecedor_id = null;
    } elseif ($transacao === 'despesas') {
        $projeto_id = null;
    }

    if (!empty($transacao) && ($transacao === 'receita' ? !empty($projeto_id) : !empty($fornecedor_id))) {
        $query = "INSERT INTO Financeiro (tipo_transacao, valor, data, descricao, projeto_id, fornecedor_id) 
                  VALUES ('$transacao', '$valor', '$data', '$descricao', " . ($projeto_id ? "'$projeto_id'" : "NULL") . ", " . ($fornecedor_id ? "'$fornecedor_id'" : "NULL") . ")";

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
    <title>Cadastrar Transação Financeira</title>
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
    <section class="section-financeiro">
        <div class="form-container" id="div-financeiro">
            <form action="" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h2>Cadastro de Transação Financeira</h2>
                </div>

                <div class="input-group">
                    <label for="tipo_transacao">Tipo de Transação:</label>
                    <select id="tipo_transacao" name="tipo_transacao" required onchange="toggleFields()">
                        <option value="">Selecione</option>
                        <option value="receita">Receita</option>
                        <option value="despesas">Despesa</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" step="0.01" required>
                </div>

                <div class="input-group">
                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required></textarea>
                </div>

                <div class="input-group" id="projeto_field" style="display: none;">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id">
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$projeto['id']}'>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group" id="fornecedor_field" style="display: none;">
                    <label for="fornecedor_id">Fornecedor:</label>
                    <select id="fornecedor_id" name="fornecedor_id">
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Fornecedor");
                        while ($fornecedor = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$fornecedor['id']}'>{$fornecedor['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" name="submit" value="Cadastrar" id="botao">
            </form>

            <script>
                function toggleFields() {
                    const tipoTransacao = document.getElementById('tipo_transacao').value;
                    const projetoField = document.getElementById('projeto_field');
                    const fornecedorField = document.getElementById('fornecedor_field');

                    if (tipoTransacao === 'receita') {
                        projetoField.style.display = 'block';
                        fornecedorField.style.display = 'none';
                    } else if (tipoTransacao === 'despesas') {
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
    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>