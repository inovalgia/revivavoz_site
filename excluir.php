<?php
// Inicia a sessão para poder destruir a sessão mais tarde (no caso do logout)
session_start(); 

// Inclui o arquivo de configuração com a conexão ao banco de dados
include_once('config.php');

// Variável para armazenar mensagens de feedback
$msg = ""; 

// Verifica se o parâmetro 'id' foi passado na URL
if (!empty($_GET['id'])) {
    // Recebe o valor do ID da URL
    $id = $_GET['id'];

    // Consulta preparada para verificar se o usuário existe no banco de dados
    $stmtSelect = $conn->prepare("SELECT id FROM usuarios WHERE id=?");
    
    // Verifica se a consulta foi preparada corretamente
    if ($stmtSelect) {
        // Associa o parâmetro da consulta (id é do tipo inteiro)
        $stmtSelect->bind_param("i", $id);
        
        // Executa 
        $stmtSelect->execute();
        
        // Armazena o resultado da consulta
        $stmtSelect->store_result();

        // Verifica se o usuário foi encontrado
        if ($stmtSelect->num_rows > 0) {
            // Verifica se o método de requisição é POST e se o formulário de confirmação foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
                // Verifica se a confirmação foi 'yes' para prosseguir com a exclusão
                if ($_POST['confirm'] == 'yes') {
                    // Consulta preparada para excluir o usuário do banco de dados
                    $stmtDelete = $conn->prepare("DELETE FROM usuarios WHERE id=?");

                    // Verifica se a consulta de exclusão foi preparada corretamente
                    if ($stmtDelete) {
                        // Associa o parâmetro da consulta (id é do tipo inteiro)
                        $stmtDelete->bind_param("i", $id);

                        // Executa a consulta de exclusão
                        if ($stmtDelete->execute()) {
                            // Destrói a sessão para deslogar o usuário após a exclusão
                            session_destroy(); 
                            $msg = "Conta excluída com sucesso."; // Mensagem de sucesso
                        } else {
                            // Caso ocorra um erro na execução da consulta de exclusão
                            $msg = "Erro ao excluir a conta: " . $stmtDelete->error;
                        }
                        // Fecha a consulta de exclusão
                        $stmtDelete->close();
                    } else {
                        // Caso ocorra um erro ao preparar a consulta de exclusão
                        $msg = "Erro ao preparar a consulta de exclusão: " . $conn->error;
                    }
                } else {
                    // Se a confirmação for diferente de 'yes', redireciona para 'sistema.php' (usuário cancelou a exclusão)
                    header('Location: sistema.php');
                    exit();
                }
            }
        } else {
            // Se o usuário não for encontrado, redireciona para 'sistema.php'
            header('Location: sistema.php');
            exit();
        }
    } else {
        // Caso ocorra um erro ao preparar a consulta de seleção (verificação do usuário)
        $msg = "Erro ao preparar a consulta de seleção: " . $conn->error;
    }
} else {
    // Se o parâmetro 'id' não for fornecido na URL, redireciona para 'sistema.php'
    header('Location: sistema.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom-style.css">
    <title>Excluir Conta</title>
</head>
<body>

<div class="container">
    <!-- Verifica se existe uma mensagem armazenada na variável $msg -->
    <?php if ($msg): ?>
        <!-- Exibe a mensagem se $msg não for vazia -->
        <p class="msg"><?= $msg ?></p>
        <!-- Link para voltar para a página inicial -->
        <a href="index.php">Voltar para a Página Inicial</a>
    <?php else: ?>
        <!-- Se não houver mensagem, exibe a pergunta de confirmação -->
        <p>Tem certeza que deseja excluir sua conta?</p>
        <!-- Formulário para confirmar a exclusão da conta -->
        <form method="POST">
            <!-- Botão para confirmar a exclusão, enviando 'yes' como valor para o parâmetro 'confirm' -->
            <button type="submit" name="confirm" value="yes">Sim, excluir</button>
            <!-- Link para cancelar a exclusão e voltar para a página 'sistema.php' -->
            <a href="sistema.php" class="cancel-btn">Cancelar</a>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

