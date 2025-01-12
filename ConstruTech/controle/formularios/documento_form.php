<?php
include_once('../conexao-bd.php');

// Inicializa variáveis
$tipo_documento = '';
$descricao = '';
$data_geracao = '';
$data_emissao = '';
$projeto_id = null;

if (isset($_POST['submit'])) {
    $tipo_documento = $_POST['tipo_documento'];
    $descricao = $_POST['descricao'];
    $data_geracao = $_POST['data_geracao'];
    $data_emissao = $_POST['data_emissao'];
    $projeto_id = $_POST['projeto_id'] ?? null;

    // Diretório para salvar os arquivos
    $diretorio_destino = '../../uploads/';

    // Verifica se o diretório existe, se não, cria
    if (!is_dir($diretorio_destino)) {
        mkdir($diretorio_destino, 0777, true);
    }

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $nome_arquivo_original = $_FILES['arquivo']['name'];
        $extensao = strtolower(pathinfo($nome_arquivo_original, PATHINFO_EXTENSION));

        // Permite apenas arquivos com extensões específicas
        $extensoes_permitidas = ['pdf', 'docx', 'jpg', 'png'];
        if (!in_array($extensao, $extensoes_permitidas)) {
            die('Formato de arquivo não permitido.');
        }

        // Gera um nome único para evitar sobrescrita
        $nome_arquivo = uniqid() . '_' . $nome_arquivo_original;
        $caminho_arquivo = $diretorio_destino . $nome_arquivo;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
            // Insere os dados no banco
            $query = "INSERT INTO Documentos (tipo_documento, descricao, data_geracao, data_emissao, arquivo, projeto_id) 
                      VALUES ('$tipo_documento', '$descricao', '$data_geracao', '$data_emissao', '$nome_arquivo', '$projeto_id')";
            $resultado = mysqli_query($conexao, $query);

            if ($resultado) {
                echo "<script>alert('Documento cadastrado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
            }
        } else {
            echo "<script>alert('Erro ao mover o arquivo para o diretório de destino.');</script>";
        }
    } else {
        echo "<script>alert('Erro no upload do arquivo. Verifique se ele foi selecionado.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Documento</title>
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
            <div class="auth-profile">
                <a href="../../visao/paginas/cadastro.php" class="logout">Voltar</a>
                <a href="../sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>
    <section class="section-documento">
        <div class="form-container" id="div-documento">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="titulo">
                    <img src="../../visao/img/ferramentas.png" alt="">
                    <h1>Cadastro de Documentos</h1>
                </div>

                <div class="input-group">
                    <label for="tipo_documento">Tipo de Documento:</label>
                    <input type="text" id="tipo_documento" name="tipo_documento" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>

                <div class="input-group">
                    <label for="data_geracao">Data de Geração:</label>
                    <input type="date" id="data_geracao" name="data_geracao" required>
                </div>

                <div class="input-group">
                    <label for="data_emissao">Data de Emissão:</label>
                    <input type="date" id="data_emissao" name="data_emissao" required>
                </div>

                <div class="input-group">
                    <label for="arquivo">Escolher Arquivo:</label>
                    <input type="file" id="arquivo" name="arquivo" required>
                </div>

                <div class="input-group">
                    <label for="projeto_id">Projeto:</label>
                    <select id="projeto_id" name="projeto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT id, nome FROM projeto");
                        while ($projeto = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='{$projeto['id']}'>{$projeto['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <input type="submit" id="botao" name="submit" value="Cadastrar">
                </div>
            </form>
        </div>
    </section>
    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>
