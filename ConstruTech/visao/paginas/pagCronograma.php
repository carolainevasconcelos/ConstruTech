<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Usuários</title>
    <link rel="stylesheet" href="../css/style-pagUsuarios.css">
    <style>
        /* Dropdown de notificações */
        .notificacoes-dropdown {
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #2c2c2c;
            /* Fundo escuro */
            width: 300px;
            border: 1px solid #444;
            /* Borda em tom escuro */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: none;
            /* Escondido por padrão */
            z-index: 10;
            max-height: 400px;
            overflow-y: auto;
            /* Permite rolar quando há muitas notificações */
            color: #fff;
        }

        /* Lista das notificações */
        .notificacoes-dropdown ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Cada notificação */
        .notificacoes-dropdown ul li {
            padding: 12px 15px;
            border-bottom: 1px solid #444;
            /* Separador em tom escuro */
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
        }

        /* Última notificação sem borda */
        .notificacoes-dropdown ul li:last-child {
            border-bottom: none;
        }

        /* Notificação ao passar o mouse */
        .notificacoes-dropdown ul li:hover {
            background-color: #444;
            /* Destaca com tom mais claro */
            transform: scale(1.02);
            /* Efeito leve de zoom */
            cursor: pointer;
        }

        /* Notificação nova */
        .notificacao-nova {
            color: #ffd700;
            /* Amarelo brilhante para destacar notificações não lidas */
            font-weight: bold;
        }

        /* Título da lista de notificações (opcional) */
        .notificacoes-titulo {
            padding: 10px 15px;
            background-color: #444;
            /* Fundo mais claro */
            color: #ffd700;
            /* Amarelo para o título */
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #555;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/ferramentas.png" alt="logo" id="logo">
                <p>ConstruTech</p>
            </div>
            <ul>
                <li><a href="cadastroColab.php">Cadastro</a></li>
                <li><a href="">Cronograma</a></li>
                <li><a href="../pagUsuarios-colab.php">Home</a></li>
                <li><a href="../../controle/listas/sistema-estoque.php">Estoque</a></li>
                <li><a href="../../controle/listas/sistema-equipamento.php">Equipamentos</a></li>
            </ul>
            <div class="auth-profile">
            <div class="profile">
    <img src="../img/notificacao.png" class="profile-icon" alt="" id="notificacao-icon">
    <div class="notificacoes-dropdown" id="notificacoes-dropdown" style="display: none;">
        <ul>
            <?php
            include_once('../../controle/conexao-bd.php'); // Certifique-se de que a conexão está correta
            $query = "SELECT * FROM Notificacoes ORDER BY id DESC";
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($notificacao = mysqli_fetch_assoc($resultado)) {
                    echo "<li>{$notificacao['mensagem']}</li>";
                }
            } else {
                echo "<li>Nenhuma notificação</li>";
            }
            ?>
        </ul>
    </div>
</div>

                <a href="../../controle/sair.php" class="logout">Sair</a>
            </div>
        </nav>
    </header>

    <main>
        <?php
        include_once('../../controle/conexao-bd.php');
        include('../../controle/listas/sistema-atividade.php');
        ?>
    </main>

    <footer>
        <p>© ConstruTech - 2024</p>
    </footer>
    <script>
        document.getElementById('notificacao-icon').addEventListener('click', function () {
    const dropdown = document.getElementById('notificacoes-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
});

    </script>

</body>

</html>