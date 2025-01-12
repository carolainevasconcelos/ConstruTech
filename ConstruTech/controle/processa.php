<?php
include('conexao-bd.php'); 

$mensagem = "";
$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailUsuario = $_POST['email'];
    $novaSenhaUsuario = $_POST['nova_senha'];

    $consulta = $conexao->prepare("SELECT * FROM funcionario WHERE email = ?");
    $consulta->bind_param("s", $emailUsuario);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $dadosUsuario = $resultado->fetch_assoc();

    if ($dadosUsuario) {
        $novaSenhaHash = password_hash($novaSenhaUsuario, PASSWORD_DEFAULT);
        $atualizaSenha = $conexao->prepare("UPDATE funcionario SET senha = ? WHERE email = ?");
        $atualizaSenha->bind_param("ss", $novaSenhaHash, $emailUsuario);
        if ($atualizaSenha->execute()) {
            echo "<script>alert('Senha atualizada com sucesso!'); window.location.href = '../visao/loginPag.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar a senha.');</script>";
        }
    } else {
        $consulta = $conexao->prepare("SELECT * FROM cliente WHERE email = ?");
        $consulta->bind_param("s", $emailUsuario);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $dadosCliente = $resultado->fetch_assoc();

        if ($dadosCliente) {
            $novaSenhaHash = password_hash($novaSenhaUsuario, PASSWORD_DEFAULT);
            $atualizaSenha = $conexao->prepare("UPDATE cliente SET senha = ? WHERE email = ?");
            $atualizaSenha->bind_param("ss", $novaSenhaHash, $emailUsuario);
            if ($atualizaSenha->execute()) {
                echo "<script>alert('Senha atualizada com sucesso!'); window.location.href = '../visao/loginPag.php';</script>";
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar a senha.');</script>";
            }
        } else {
            echo "<script>alert('Email não encontrado.');</script>";
        }
    }
}
?>
