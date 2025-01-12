<?php
session_start();
include_once('../controle/conexao-bd.php');
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
}
$logado = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Usuários</title>
    <link rel="stylesheet" href="css/style-pagUsuarios.css">
    <link rel="stylesheet" href="css/profileMenu.css">
    <script src="js/profileMenu.js"></script>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="paginas/pagProjeto.php">Projetos</a></li>
                <li><a href="">Home</a></li>
                <!-- <li><a href="paginas/pagFinanceiro.php">Financeiro</a></li> -->
                <li><a href="paginas/atendimento.php">Atendimento</a></li>
            </ul>
            <div class="auth-profile">
                <div class="profile">
                    <!-- Mensagem de boas-vindas oculta inicialmente -->
                    <div class="welcome-message" id="welcomeMessage">
                        <?php echo "<h1>Bem-vindo, <u>$logado</u></h1>"; ?>
                    </div>
                    <img src="img/profile-icon.png" alt="User Profile" class="profile-icon"
                        onclick="toggleWelcomeMessage()">
                </div>
                <a href="../controle/sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>

    <section class="paragraph">
        <div class="paragraph-text">
            <h1>The best way to showcase your project.</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur cum nemo nobis doloremque totam, optio
                excepturi iste exercitationem ipsum ipsa ex reiciendis, fugit, perspiciatis recusandae vitae ipsam
                aliquam corporis eveniet!</p>
        </div>

        <div class="diagonal-bg">
            <div class="diagonal"></div>
            <div class="diagonal-shadow"></div>
        </div>
    </section>

    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>