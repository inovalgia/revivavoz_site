<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/svg" href="css/resources/logo_icon_nav.svg" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>


<body>
    
    <div class="container glow-on-hover">
        <!-- onde os dados vao ser validados -->
        <form action="logar.php" method="post">
        <a href="index.php"><img src="css/resources/logo_revivavoz.svg" alt=""></a>
            <h1> Entrar na conta </h1>
            
            <div class="container-dados">
                <input type="text" placeholder="E-mail" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="container-dados">
                <input type="password" placeholder="Senha" name="senha" required>
                <i class='bx bxs-lock-alt'></i>
            </div>


            <div class="opcao-um">
                <label><input type="checkbox"> Lembrar-me </label>
                <a href="#"> Esqueceu a senha? </a>
            </div>

         
            <input type="submit" name="submit" value="Entrar" class="botao">
 
            <div class="link-cadastrar">
                <p> Não tem uma conta? <a href="cadastro.php"> Inscreva-se aqui! </a></p>
            </div>
            <div class="link-cadastrar">
                <p> Voltar para a <a href="index.php"> página inicial. </a></p>
            </div>

        </form>
        
    </div>
    
</body>
</html>