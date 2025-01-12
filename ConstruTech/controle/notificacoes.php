<?php
include_once('conexao-bd.php');
session_start();

header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não logado.']);
    exit;
}

// Obtém o ID do usuário logado da sessão
$usuario_id = $_SESSION['usuario_id'];

// Consulta as notificações vinculadas ao usuário logado
$query = "SELECT id, mensagem, status, data 
          FROM Notificacoes 
          WHERE usuario_id = ? AND status = 'não lida'
          ORDER BY data DESC";
$stmt = $conexao->prepare($query);
$stmt->bind_param('i', $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$notificacoes = [];

if ($resultado && $resultado->num_rows > 0) {
    while ($notificacao = $resultado->fetch_assoc()) {
        $notificacoes[] = $notificacao;
    }
}

echo json_encode($notificacoes);
?>