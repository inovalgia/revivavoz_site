<?php
include("config.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: logar.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Usuário</title>
    <link rel="shortcut icon" href="css/resources/logo_icon_nav.svg" type="image/x-icon">
</head>
<body>
    <h2>Bem-vindo, <?php echo $user['nome']; ?>!</h2>
    <p>Email: <?php echo $user['email']; ?></p>
    <a href="editar.php?id=<?php echo $user['id']; ?>">Editar dados</a><br><br>
    <a href="excluir.php?id=<?php echo $user['id']; ?>">Excluir conta</a>
    
</body>
</html>
