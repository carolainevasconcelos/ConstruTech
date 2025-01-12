<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Usuários</title>
    <link rel="stylesheet" href="../css/style-pagUsuarios.css">
    <link rel="stylesheet" href="../css/style-cadastro.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="">Cadastro</a></li>
                <li><a href="pagCronograma.php">Cronograma</a></li>
                <li><a href="../pagUsuarios-colab.php">Home</a></li>
                <li><a href="../../controle/listas/sistema-estoque.php">Estoque</a></li>
                <li><a href="../../controle/listas/sistema-equipamento.php">Equipamentos</a></li>
            </ul>
            <div class="auth-profile">
                <a href="../../controle/sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>

    <section class="cadastramento">
        <h1>Área de Cadastramento</h1>
        <div class="carousel-container">
            <div class="card-container">
                <div class="card">
                    <a href="../../controle/formularios/atividade_form.php">Atividade</a>
                </div>
                <div class="card">
                    <a href="../../controle/formularios/Estoque_form.php">Estoque</a>
                </div>
                <div class="card">
                    <a href="../../controle/formularios/equipamento_form.php">Equipamento</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>