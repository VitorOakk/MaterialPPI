<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="login-container">
            <h1>LOGIN</h1>
            <form action="" method="post">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Default: user">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Default: user">
                <input type="submit" value="Entrar" class="btn">
            </form>
            <p>Não tem uma conta? <a href="cadastro.php">Registre-se</a></p>
            <?php
    session_start();
    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        require_once "conexao.php";
        require_once "usuarioEntidade.php";
        
        $conn = new Conexao();

        $sql = "SELECT * FROM `users` WHERE Usuario = ? and Senha = ?";
        $stmt = $conn->conexao->prepare($sql);

        $stmt->bindParam(1, $_POST["usuario"]);
        $stmt->bindParam(2, $_POST["senha"]);
        

        $resultado = $stmt->execute();

        if($stmt->rowCount() == 1) {

            $usuario = new usuarioEntidade();
            
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $usuario->setUser($rs->Usuario);
                $usuario->setPassword($rs->Senha);
                $usuario->setName($rs->Nome);
            }

            $_SESSION["login"] = "1";
            $_SESSION["usuario"] = $usuario->getUser();
            $_SESSION["Nome"] = $usuario->getName();
            header("Location: login.php");
        }
        else {
            echo "<h2 class='warning'>Usuário ou senha inválidos</h2>";
        }
    }
?>
        </div>
    </main>
   
</body>
</html>