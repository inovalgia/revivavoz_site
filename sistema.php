<?php  
    session_start();
    include_once('config.php');
    if((!isset($_SESSION['email']) == true ) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location: login.php");
    }
    $email_logado = $_SESSION['email'];


    // Consulta preparada para buscar o nome do usuário
    $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE email = ?");

    if ($stmt) {
        $stmt->bind_param("s", $email_logado);
        $stmt->execute();
        $stmt->bind_result($nome_usuario); // Armazena o nome do usuário em $nome_usuario
        $stmt->fetch();
        $stmt->close();

        if (isset($nome_usuario)) { // Verifica se o nome foi encontrado
            $logado = $nome_usuario;
        } else {
            $logado = $email_logado; // Usa o email como fallback se o nome não for encontrado
        }

        // Consulta preparada para obter o ID e o nome do usuário
        $stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE email = ?"); // Consulta corrigida
        if ($stmt) {
            $stmt->bind_param("s", $email_logado);
            $stmt->execute();
            $stmt->bind_result($id_usuario, $nome_usuario); // Corrigido: adicionado $id_usuario
            $stmt->fetch();
            $stmt->close();
            $logado = $nome_usuario ?: $email_logado; // Define $logado
        } else {
            die("Erro na consulta: " . $conn->error);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Shows</title>
    <link rel="stylesheet" href="css/painel-style.css">
    <link rel="icon" type="image/svg" href="css/resources/logo_icon_nav.svg" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div id="main-container">
    <img src="css/resources/logo_revivavoz.svg" alt="">
    <!-- Exibe uma mensagem de boas-vindas personalizada com o nome do usuário logado -->
        <h1 id="welcome-message"><?php echo "Bem-vindo(a) " . $logado; ?></h1>

        <!-- Botões para editar e excluir -->
        <div id="buttons">
        <!-- Link para a página de edição de informações do usuário, passando o id do usuário como parâmetro -->
            <a href="editar.php?id=<?php echo $id_usuario; ?>" id="edit-btn"><button>Editar Informações</button></a>
            <a href="excluir.php?id=<?php echo $id_usuario; ?>" id="delete-btn"><button>Excluir Conta</button></a>
            <a href="index.php" id="home-btn"><button>Voltar à Página Inicial</button></a>
            <a href="sair.php" id="home-btn"><button>Sair da Conta</button></a>
        </div>

        <!-- Tabela de Shows -->
        <table id="shows-table">
            <caption><strong>Próximos Shows:</strong></caption>
            <thead>
                <tr>
                    <th>Artistas</th>
                    <th>Covers</th>
                    <th>Local</th>
                    <th>Data</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pedro Silva</td>
                    <td>Legião Urbana</td>
                    <td>RockCenter - Salvador, BA</td>
                    <td>13/11/2024</td>
                    <td>19:00</td>
                </tr>
                <tr>
                    <td>Luisa Andrade</td>
                    <td>Alquimia do som</td>
                    <td>RockCenter - Ilhéus, BA</td>
                    <td>25/11/2024</td>
                    <td>18:30</td>
                </tr>
                <tr>
                    <td>Vagner Borba</td>
                    <td>Capital Inicial</td>
                    <td>RockCenter - Campinas, SP</td>
                    <td>19/11/2024</td>
                    <td>20:30</td>
                </tr>
                <tr>
                    <td>Mariana Ferreira</td>
                    <td>Rita Lee</td>
                    <td>RockCenter - Santos, SP</td>
                    <td>01/12/2024</td>
                    <td>18:00</td>
                </tr>

                <tr>
                    <td>Banda O legado</td>
                    <td>Titãs</td>
                    <td>RockCenter - Fortaleza, CE</td>
                    <td>10/12/2024</td>
                    <td>19:30</td>
                </tr>

            </tbody>
        </table>
    </div>
</body>
</html>
