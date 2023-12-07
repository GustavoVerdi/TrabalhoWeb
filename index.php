<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Tela do Administrador</title>
</head>

<body>
    <h1>Bem-vindo, Administrador!</h1>
    <a href="cadastrousuario.html">Cadastrar Novo Cliente</a>
    <form action="" method="get">
        <label for="busca">Buscar Cliente:</label>
        <input type="text" id="busca" name="busca" placeholder="Digite o nome do cliente">
        <input type="submit" value="Buscar">
    </form>

    <div>
        <h1>Lista de Clientes</h1>
        <?php

        $host = 'localhost';
        $port = '5432';
        $dbname = 'trabalhofinal';
        $user = 'postgres';
        $password = '123456';

        try {
            $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $tabela = 'usuario';

            $termoBusca = isset($_GET['busca']) ? $_GET['busca'] : '';

            if(!empty($termoBusca)) {
                $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE nome ILIKE :termo");
                $stmt->bindValue(':termo', "%$termoBusca%", PDO::PARAM_STR);
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($clientes)) {
                    echo '<table>';
                    echo '<tr><th>Nome</th><th>Sobrenome</th><th>Data de Nascimento</th><th>Email</th></tr>';
                    foreach($clientes as $cliente) {
                        echo '<tr>';
                        echo '<td>'.$cliente['nome'].'</td>';
                        echo '<td>'.$cliente['sobrenome'].'</td>';
                        echo '<td>'.$cliente['datenas'].'</td>';
                        echo '<td>'.$cliente['email'].'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>Nenhum resultado encontrado.</p>';
                }
            } else {
                $stmt = $conexao->query("SELECT * FROM $tabela");
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($clientes)) {
                    echo '<table>';
                    echo '<tr><th>Nome</th><th>Sobrenome</th><th>Data de Nascimento</th><th>Email</th></tr>';
                    foreach($clientes as $cliente) {
                        echo '<tr>';
                        echo '<td>'.$cliente['nome'].'</td>';
                        echo '<td>'.$cliente['sobrenome'].'</td>';
                        echo '<td>'.$cliente['datenas'].'</td>';
                        echo '<td>'.$cliente['email'].'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>Nenhum cliente cadastrado.</p>';
                }
            }
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: ".$e->getMessage();
        }

        ?>
    </div>
</body>

</html>
