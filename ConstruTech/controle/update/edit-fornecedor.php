<?php
if (!empty($_GET['id'])) {
    include_once('../conexao-bd.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM fornecedor WHERE id=$id";

    $result_fornecedor = $conexao->query($sqlSelect);

    if ($result_fornecedor->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result_fornecedor)) {
            $nome = $user_data['nome'];
            $nome_fantasia = $user_data['nome_fantasia'];
            $cnpj = $user_data['cnpj'];
            $email = $user_data['email'];
            $telefone = $user_data['telefone'];
            $endereco = $user_data['endereco'];
        }
    } else {
        header('Location: ../listas/sistema-fornecedor.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
    <link rel="stylesheet" href="../../visao/css/formCadastro.css">
</head>

<body>
    <section class="section-fornecedor">
        <div class="form-container" id="div-fornecedor">
            <form action="saveEdit-fornecedor.php" method="POST">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Editar Fornecedor</h1>
                </div>

                <div class="input-group">
                    <label for="nome">Nome:</label>
                    <input type="text" value="<?php echo htmlspecialchars($nome); ?>" id="nome" name="nome" required>
                </div>

                <div class="input-group">
                    <label for="nome_fantasia">Nome Fantasia:</label>
                    <input type="text" value="<?php echo htmlspecialchars($nome_fantasia); ?>" id="nome_fantasia"
                        name="nome_fantasia" required>
                </div>

                <div class="input-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" value="<?php echo htmlspecialchars($cnpj); ?>" id="cnpj" name="cnpj" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" value="<?php echo htmlspecialchars($email); ?>" id="email" name="email"
                        required>
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" value="<?php echo htmlspecialchars($telefone); ?>" id="telefone" name="telefone">
                </div>

                <div class="input-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" value="<?php echo htmlspecialchars($endereco); ?>" id="endereco" name="endereco">
                </div>

                <!-- Campo oculto para o ID do fornecedor -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="input-group">
                    <input type="submit" name="submit" value="Salvar" id="botao">
                </div>
            </form>

            <!-- <div>
                <a href="../listas/sistema-fornecedor.php">Voltar</a>
            </div> -->
        </div>
    </section>
</body>

</html>