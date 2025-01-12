<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ConstruTech</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../visao/css/style-login.css">
    <script src="../visao/js/validarCampos.js" defer></script>
</head>

<body>
    <section>
        <div class="form-box">
            <div>
                <form action="../controle/login.php" method="post">
                    <div class="titulo">
                        <img src="../visao/img/ferramentas.png" alt="">
                        <h1>Login</h1>
                    </div>

                    <div class="inputbox">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="usuario" required>
                        <label for="">Usuário</label>
                    </div>
                    <div class="inputbox">
                        <i class="material-icons">lock</i>
                        <input type="password" name="senha" required>
                        <label for="">Senha</label>
                    </div>
                    <a href="esqueceu.php" class="link">Esqueceu sua senha?</a>
                    <div class="button-container">
                        <input type="submit" class="buttons" name="submit" value="Entrar">
                        <button type="button" class="buttons" id="voltarBotao">Voltar</button>
                        </div>
                    <a href="../controle/definirSenha.php" class="link" id="create-password">&#9872; Crie uma senha</a>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("voltarBotao").addEventListener("click", function () {
            window.location.href = "index.php";
        });
    </script>
</body>

</html>