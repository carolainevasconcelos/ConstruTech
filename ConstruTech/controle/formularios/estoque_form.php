<?php 
// Inclui o arquivo de conexão com o banco de dados
include_once('../conexao-bd.php');

// Inicializa as variáveis para evitar warnings
$produto = '';
$qtd = '';
$movimentacao = '';
$data = '';
$financeiro_id = null;
$projeto_id = null;
$mensagem_sucesso = '';

if (isset($_POST['submit'])) {
    // Obtém os valores enviados pelo formulário
    $produto = $_POST['produto'];
    $qtd = $_POST['quantidade_total'];
    $movimentacao = $_POST['tipo_movimentacao'];
    $data = $_POST['data_movimentacao'];
    $projeto_id = $_POST['projeto_id'];

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Insere na tabela Estoque
    $sql = "INSERT INTO estoque (produto, quantidade_total, tipo_movimentacao, data_movimentacao, projeto_id, financeiro_id) 
            VALUES ('$produto', '$qtd', '$movimentacao', '$data', '$projeto_id', " . ($financeiro_id === null ? "NULL" : "'$financeiro_id'") . ")";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // Define a mensagem de sucesso
        $mensagem_sucesso = "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao inserir na tabela Estoque: " . mysqli_error($conexao);
    }

    // Caso seja uma movimentação de entrada, registra no financeiro
    if ($movimentacao === 'entrada') {
        $valor_despesa = 100.00; // Ajuste para o valor apropriado
        $descricao = "Despesa gerada pela movimentação de entrada do produto $produto";

        $sql_financeiro = "INSERT INTO financeiro (tipo_transacao, valor, data, descricao, projeto_id) 
                           VALUES ('despesas', '$valor_despesa', '$data', '$descricao', '$projeto_id')";
        $resultado_financeiro = mysqli_query($conexao, $sql_financeiro);

        if (!$resultado_financeiro) {
            echo "Erro ao registrar a despesa no Financeiro: " . mysqli_error($conexao);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentação de Estoque</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
    <link rel="stylesheet" href="../../visao/css/style-pagUsuarios.css">
    <script src="../../visao/js/validarCampos.js" defer></script>
    <script>
        // Exibe a mensagem de sucesso, se definida
        window.onload = function() {
            const mensagem = "<?php echo $mensagem_sucesso; ?>";
            if (mensagem) {
                alert(mensagem);
            }
        }
    </script>
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
    <section class="section-estoque">
        <div class="form-container" id="div-estoque">
            <form action="" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h2>Cadastro de Estoque</h2>
                </div>

                <div class="input-group">
                    <label for="produto">Produto:</label>
                    <input type="text" id="produto" name="produto" required>
                </div>

                <div class="input-group">
                    <label for="quantidade_total">Quantidade Total:</label>
                    <input type="number" id="quantidade_total" name="quantidade_total" required>
                </div>

                <div class="input-group">
                    <label for="tipo_movimentacao">Tipo de Movimentação:</label>
                    <select id="tipo_movimentacao" name="tipo_movimentacao" required>
                        <option value="">Selecione</option>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="data_movimentacao">Data da Movimentação:</label>
                    <input type="date" id="data_movimentacao" name="data_movimentacao" required>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select name="projeto_id" id="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        // Preenche as opções do projeto
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM Projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$projeto['id']}'>{$projeto['nome']}</option>";
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
