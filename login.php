<?php
session_start();

$host = 'localhost';
$port = '5432';
$dbname = 'trabalhofinal';
$user = 'postgres';
$password = '123456';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idlogin = $_POST['idlogin'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM logins WHERE idlogin = :idlogin AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idlogin', $idlogin);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if ($idlogin == $usuario['idlogin'] && $senha == $usuario['senha']) {
            $_SESSION['idlogin'] = $usuario['idlogin'];

            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Credenciais inválidas. Por favor, verifique suas informações.");</script>';
        }
    } else {
        echo '<script>alert("Usuário não encontrado. Por favor, verifique suas informações.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="idlogin">Credencial:</label>
        <input type="text" id="idlogin" name="idlogin" required>
    
        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" required>
        <input type="submit" value="Logar">
    </form>
</body>
</html>
