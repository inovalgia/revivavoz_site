<?php
    // Inicia a sessão para que o PHP possa armazenar informações do usuário enquanto ele navega entre páginas
    session_start();

    $msg ="";
    // Verifica se o formulário foi enviado e se os campos 'email' e 'senha' não estão vazios
    if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        // Inclui o arquivo de configuração (onde se conecta ao banco de dados)
        include_once('config.php');
        
        // Obtém o valor do email e senha enviados pelo formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Cria uma consulta SQL para verificar se existe um usuário com o email e senha informados
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

        // Executa a consulta no banco de dados
        $result = $conn->query($sql);

        // Verifica se o resultado da consulta encontrou algum usuário
        if(mysqli_num_rows($result) < 1)
        {
            // Se não encontrar nenhum usuário, limpa as variáveis de sessão e redireciona para a página de login
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            $msg = "Usuario ou senha incorretos.";
            header("Location: sistema.php");
        }
        else
        {
            // Se encontrar um usuário, cria variáveis de sessão para armazenar o email e a senha
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: sistema.php"); // Redireciona para a página principal do sistema
        }
    }
    else
    {
        // Se o formulário não foi enviado corretamente ou os campos estão vazios, redireciona para a página de login
        $msg = "Oops! Algo deu errado.";
        header("Location: login.php");
    }
?>
