<?php
// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
// Recebe os valores dos campos 'nome', 'senha' e 'email' que foram preenchidos no formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

// Inclui o arquivo de configuração do banco de dados (onde está a conexão com o banco)
    include_once('config.php');

// Prepara a consulta SQL para inserir os dados na tabela 'usuarios'
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha, email) VALUES (?, ?, ?)");

// Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
    // Associa os parâmetros da consulta SQL (são 3 strings: nome, senha e email)
        $stmt->bind_param("sss", $nome, $senha, $email);

// Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            // Se a consulta for executada com sucesso, exibe uma mensagem de sucesso
            echo "Cadastro realizado com sucesso!";
            header("Location: login.php");
            // Encerra a execução do script para garantir que o redirecionamento aconteça
            exit();


        } else {
        // Se ocorrer algum erro ao executar a consulta, exibe a mensagem de erro
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();

    } else {
    // Se houver um erro ao preparar a consulta SQL, exibe a mensagem de erro
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscreva-se</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/svg" href="css/resources/logo_icon_nav.svg"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container" id="container-cadastro">
        <!-- onde os dados vao ser processados -->
        <form action="cadastro.php" method="post">
            <a href="index.php"><img src="css/resources/logo_revivavoz.svg" alt=""></a>
            <h1> Inscreva-se </h1>
            <div class="container-dados">
                <input type="text" placeholder="Digite seu nome de usuário" name="nome" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="container-dados">
                <input type="password" placeholder="Digite uma senha" name="senha" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="container-dados">
                <input type="email" placeholder="Digite seu e-mail" name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="opcao-um" id="opcao-dois">
                <label><input type="checkbox"> Eu aceito os <a href="#"> Termos e Condições do Evento RevivaVoz. </a></label>
                <label><input type="checkbox"> Desejo receber notificações de novos eventos, promoções e muito mais por e-mail. </a></label>
            </div>
            <button id="button" type="submit" class=" glow-on-hover botao" name="submit">Inscrever-me</button>

            <div class="ja-possui-conta">
                <p>Já possui conta? <a href="login.php">Faça login</a></p>
            </div>
        </form>
    </div>
</body>
</html>