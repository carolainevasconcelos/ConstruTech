<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>

<body>
    <section>
        <div class="form-box">
            <form action="../controle/processa.php" method="post">
                <div class="titulo">
                    <img src="../visao/img/ferramentas.png" alt="">
                    <h1>Esqueceu a Senha</h1>
                </div>
                
                <div class="inputbox">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                
                <div class="inputbox">
                    <input type="password" id="nova_senha" name="nova_senha" required>
                    <label for="nova_senha">Nova Senha</label>
                </div>

                <div class="button-container">
                    <input type="submit" class="buttons" name="submit">
                    <button type="button" class="buttons" id="voltarBotao">Voltar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.getElementById("voltarBotao").addEventListener("click", function () {
            window.location.href = "loginPag.php";
        });
    </script>
</body>

</html>
