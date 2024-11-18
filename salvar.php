<?php
    session_start(); // Inicia a sessão para poder acessar e modificar dados de sessão
    include_once('config.php'); // Inclui o arquivo de configuração para acessar o banco de dados

    // Verifica se o formulário foi submetido com o botão 'submit'
    if(isset($_POST['submit'])) {
        // Recebe os dados do formulário (id, nome, senha e email)
        $id = $_POST['id'];
        $novo_nome = $_POST['nome'];
        $nova_senha = $_POST['senha'];
        $novo_email = $_POST['email'];

        // Previne injeção de SQL ao usar instruções preparadas
        if (!empty($nova_senha)) { // Verifica se a senha foi alterada
            // Cria um hash da nova senha antes de armazená-la no banco de dados (senha criptografada)
            $senha_hash = ($nova_senha);

            // Prepara a consulta para atualizar o nome, email e senha
            $stmt = $conn->prepare("UPDATE usuarios SET nome=?, email=?, senha=? WHERE id=?");
            $stmt->bind_param("ssss", $novo_nome, $novo_email, $senha_hash, $id); // Faz a ligação entre as variáveis e os parâmetros da consulta
        } else { // Caso a senha não tenha sido alterada
            // Prepara a consulta para atualizar apenas nome e email
            $stmt = $conn->prepare("UPDATE usuarios SET nome=?, email=? WHERE id=?");
            $stmt->bind_param("ssi", $novo_nome, $novo_email, $id); // Faz a ligação das variáveis com os parâmetros da consulta
        }

        // Executa a consulta preparada
        if ($stmt->execute()) {
            // Se a consulta for bem-sucedida, atualiza a sessão com os novos dados do usuário
            $_SESSION['email'] = $novo_email;
            $_SESSION['nome'] = $novo_nome;

            // Redireciona o usuário para a página sistema.php (página principal do sistema)
            header('Location: sistema.php');
            exit(); // Garante que o código após o redirecionamento não será executado
        } else {
            // Se ocorrer algum erro ao executar a consulta, exibe a mensagem de erro
            echo "Erro ao atualizar: " . $stmt->error;
        }
    } else {
        // Se o formulário não foi enviado, redireciona para a página de edição
        header('Location: editar.php'); // Ou sistema.php, dependendo da lógica da aplicação
        exit(); // Garante que o código após o redirecionamento não será executado
    }
?>
