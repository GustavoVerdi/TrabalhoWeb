<?php
$host = 'localhost';
$port = '5432';
$dbname = 'verdi';
$user = 'postgres';
$password = '1234';

try {
    $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $datenas = $_POST["datenas"];
        $email = $_POST["email"];

        $stmt = $conexao->prepare("INSERT INTO usuario (nome, sobrenome, datenas, email) VALUES (:nome, :sobrenome, :datenas, :email)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':datenas', $datenas);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo '<script>';
        echo 'if(Notification.permission === "granted") {';
        echo '  new Notification("Cadastro realizado com sucesso!");';
        echo '  setTimeout(function(){ window.location.href = "index.php"; }, 1000);';  // Redireciona após 3 segundos
        echo '} else if(Notification.permission !== "denied") {';
        echo '  Notification.requestPermission().then(function(permission) {';
        echo '    if(permission === "granted") {';
        echo '      new Notification("Cadastro realizado com sucesso!");';
        echo '      setTimeout(function(){ window.location.href = "index.php"; }, 1000);';  // Redireciona após 3 segundos
        echo '    }';
        echo '  });';
        echo '}';
        echo '</script>';
    }
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
