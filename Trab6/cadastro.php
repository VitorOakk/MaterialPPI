<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="login-container">
            <h1>Cadastrar</h1>
            <form action="" class="" method="post">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="senha">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha">
                <input type="submit" value="Cadastrar" class="btn">
            </form>
            <p>Ja tem uma conta? <a href="index.php">Login</a></p>
            <?php
                session_start();
                if(isset($_POST["nome"]) && isset($_POST["usuario"]) && isset($_POST["senha"])){
                    require_once "conexao.php";
                    require_once "usuarioEntidade.php";

                    $nome = $_POST["nome"];
                    $usuario = $_POST["usuario"];
                    $senha = $_POST["senha"];

                    $conn = new Conexao();
                    $sql = "INSERT INTO users(Nome, Usuario, Senha) VALUES (:nome, :usuario, :senha)";

                    $stmt = $conn->conexao->prepare($sql);

                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':usuario', $usuario);
                    $stmt->bindParam(':senha', $senha);

                    $result = $stmt->execute();

                    if($result){
                        echo "<h2>Sucesso</h2>";
                    }
                    else echo "<h2>Falha<h2>";

                }

            
            ?>
        </div>
    </main>
</body>
</html>