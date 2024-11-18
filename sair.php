<?php
    // Inicia a sessão para poder manipular as variáveis de sessão
    session_start();

    // Remove a variável de sessão 'email' (desfazendo o login do usuário)
    unset($_SESSION['email']);

    // Remove a variável de sessão 'senha' (desfazendo o login do usuário)
    unset($_SESSION['senha']);

    // Redireciona o usuário para a página de login após deslogá-lo
    header("Location: login.php");
?>
