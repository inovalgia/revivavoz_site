<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviva Voz</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="css/resources/logo_icon_nav.svg" type="image/x-icon">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="css/resources/logo_revivavoz.svg" alt="">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="#" class="nav-link" data-frame="sobre-nos">Sobre Nós</a></li>
            <li><a href="#" class="nav-link" data-frame="Regulamento">Regulamento</a></li>
            <li><a href="#" class="nav-link" data-frame="informaçoes-adicionais">Informações adicionais</a></li>
            <li><a href="cadastro.php" class="">Cadastro</a></li>
             <li><a href="login.php" class="">Entrar</a></li>
            <li><a href="sistema.php" class="icon-user">
                <img src="css/resources/icon_usuario.svg" class="user-icon">
            </a></li>
        </ul>
    </nav>
  </header>

  <!-- Frame Dinâmico (onde o conteúdo aparecerá) -->
  <div id="dynamic-frame" class="dynamic-frame">
      <button id="back-button" class="back-button">Voltar para a Tela Inicial</button>
</div>
  </div>

  <div class="landing-page" id="initial-content">
    <div class="conteudo">
        <h1>Revivendo o Rock Nacional!</h1>
        <h2>O maior festival Cover de Rock</h2>
        <p>
            De Cazuza a Rita Lee, de Raul Seixas ao Capital Inicial, o rock nacional é 
            um verdadeiro tributo de talentos e histórias. E mais do que isso, é uma 
            experiência resgatando essas memórias! <br><span>É com esse objetivo que o <strong>REVIVA VOZ</strong> surgiu.</span>
        </p>
        <div class="botoes">
            <a href="cadastro.php" class="botao roxo">Inscreva-se</a>
            <a href="programacao.php" class="botao cinza">Programação</a>
        </div>
    </div>
  </div>
  <script src="script.js"></script>

</body>
</html>
