<?php
// Verifica se o parâmetro 'id' foi passado na URL (via método GET)
if(!empty($_GET['id'])) {
    // Inclui o arquivo de configuração que contém a conexão com o banco de dados
    include_once('config.php');

    // Recebe o valor do parâmetro 'id' da URL e armazena na variável $id
    $id = $_GET['id'];

    // Cria a consulta SQL para selecionar os dados do usuário com o id específico
    $sqlSelect = "SELECT * FROM usuarios WHERE id = $id";

    // Executa a consulta SQL e armazena o resultado na variável $result
    $result = $conn->query($sqlSelect);

    // Verifica se a consulta retornou algum resultado (se o usuário foi encontrado)
    if($result->num_rows > 0) {
        // Se o usuário for encontrado, percorre os dados retornados
        while($user_data = mysqli_fetch_assoc($result)) {
            // Armazena os dados do usuário nas variáveis
            $nome = $user_data['nome'];
            $senha = $user_data['senha'];
            $email = $user_data['email'];
        }
    } else {
        // Se nenhum usuário for encontrado, redireciona o usuário para a página 'sistema.php'
        header('Location: sistema.php');
    }
}
?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Usuário</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/svg" href="css/resources/logo_icon_nav.svg" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    
</head>
<body>
    <div class="container" id="container-cadastro">
        <!-- onde os dados vao ser alterados -->
        <form action="salvar.php" method="post">
            <img src="css/resources/logo_revivavoz.svg" alt="">
            <h1> Dados da Conta </h1>
            <p> Aqui você pode alterar os dados da sua conta</p>
            <div class="container-dados">
                <input type="text" placeholder="Nome de Usuário" name="nome" value="<?php echo $nome; ?>">
                <i class='bx bxs-user'></i>
            </div>
            <div class="container-dados">
                <input type="password" placeholder="Senha" name="senha">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="container-dados">
                <input type="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
                <i class='bx bxs-envelope'></i>
            </div>




           


            <input type="hidden" name="id" value="<?php echo $id; ?>"><button id="button" type="submit" class=" glow-on-hover botao" name="submit">Salvar e Voltar</button></input>


        </form>


    </div>
</body>
</html>