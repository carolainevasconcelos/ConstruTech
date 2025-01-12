<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento ao Cliente</title>
    <link rel="stylesheet" href="../css/style-pagUsuarios.css">
    <link rel="stylesheet" href="../css/style-atendimento.css">
</head>

<body>
<header>
        <nav>
            <div class="logo">
                <img src="../img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="pagProjeto.php">Projetos</a></li>
                <!-- <li><a href="pagFinanceiro.php">Financeiro</a></li> -->
                <li><a href="../pagUsuarios-cliente.php">Home</a></li>
                <li><a href="">Atendimento</a></li>
            </ul>
            <div class="auth-profile">
                <a href="../../controle/sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>

    <section class="atendimento">
        <div class="container">
            <h1>Iniciar Atendimento</h1>

            <div class="opcoes-atendimento">
                <!-- Botão para enviar e-mail -->
                <a href="mailto:vasconcelos.carol.246@gmail.com?subject=Atendimento%20Cliente" class="botao-email">
                    <img src="../img/gmail.png" alt="Ícone de e-mail">
                    <p>Enviar e-mail</p>
                </a>

                <!-- Botão para iniciar conversa no WhatsApp -->
                <a href="https://wa.me/55985323074?text=Olá,%20preciso%20de%20atendimento." class="botao-whatsapp" target="_blank">
                    <img src="../img/whatsapp.png" alt="Ícone de WhatsApp">
                    <p>Enviar mensagem no WhatsApp</p>
                </a>
            </div>
        </div>
    </section>
    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
</body>

</html>
