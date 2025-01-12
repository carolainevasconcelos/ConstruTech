<?php
include_once('../controle/conexao-bd.php');

if (isset($_POST['submit'])) {
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmarSenha'];
    $usuario = $_POST['usuario'];

    if ($senha !== $confirmSenha) {
        echo "<script>alert('As senhas não conferem.');</script>";
    } else {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM Cliente WHERE cpf = '$usuario' OR cnpj = '$usuario'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $sqlUpdate = "UPDATE Cliente SET senha = '$senhaCriptografada' WHERE cpf = '$usuario' OR cnpj = '$usuario'";
            if (mysqli_query($conexao, $sqlUpdate)) {
                header('Location: ../visao/loginPag.php'); 
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar a senha no Cliente.');</script>";
            }
        } else {
            $sql = "SELECT * FROM Funcionario WHERE cpf = '$usuario'";
            $resultado = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($resultado) > 0) {
                $sqlUpdate = "UPDATE Funcionario SET senha = '$senhaCriptografada' WHERE cpf = '$usuario'";
                if (mysqli_query($conexao, $sqlUpdate)) {
                    header('Location: ../visao/loginPag.php');
                    exit;
                } else {
                    echo "<script>alert('Erro ao atualizar a senha no Funcionario.');</script>";
                }
            } else {
                echo "<script>alert('Usuário não encontrado. Verifique o CPF ou CNPJ.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Senha - ConstruTech</title>
    <link rel="stylesheet" href="../visao/css/style-login.css">
    <script src="js/validarCampos.js" defer></script>
</head>

<body>
    <section>
        <div class="form-box">
            <div>
                <form action="" method="post" onsubmit="return confereSenha();">
                    <div class="titulo">
                        <img src="../visao/img/ferramentas.png" alt="">
                        <h1>Criar Senha</h1>
                    </div>

                    <div class="inputbox">
                        <input type="text" name="usuario" required>
                        <label for="">CPF ou CNPJ</label>
                    </div>

                    <div class="inputbox">
                        <input type="password" name="senha" required onchange='confereSenha();'>
                        <label for="">Senha</label>
                    </div>

                    <div class="inputbox">
                        <input type="password" name="confirmarSenha" required onchange='confereSenha();'>
                        <label for="">Confirmar senha</label>
                    </div>

                    <div class="button-container">
                        <input type="submit" class="buttons" name="submit" value="Criar">
                        <button type="button" class="buttons" id="voltarBotao">Voltar</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("voltarBotao").addEventListener("click", function () {
            window.location.href = "../visao/loginPag.php";
        });

        function confereSenha() {
            const senha = document.querySelector('input[name=senha]'); //const define uma variável cujo valor não pode ser reatribuído
            const confirmarSenha = document.querySelector('input[name=confirmarSenha]');

            if (confirmarSenha.value === senha.value) {
                confirmarSenha.setCustomValidity('');
                return true; // Permite o envio do formulário
            } else {
                confirmarSenha.setCustomValidity('As senhas não conferem');
                return false; // Bloqueia o envio do formulário
            }
        }
    </script>
</body>

</html>