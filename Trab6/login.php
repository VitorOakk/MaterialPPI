<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login-style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar nav-expand-lg bg-dark d-flex flex-row vw-100">
        <form action="" method ="post"><input type="submit" value="Sair" name="sair" class="btn btn-light px-3 mx-5"></form>
        </nav>
    </header>
    <main class="d-flex flex-column my-4">
        <h1 class="mx-6">Ola, <?php echo $_SESSION['Nome']; ?>!</h1>
        <?php
            if(isset($_POST["sair"])){
        
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            }
        ?>
        
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuario</th>
                    <th>Action</th>
        
        
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "conexao.php";
                    $conn = new Conexao();
                    $sql = "SELECT * FROM users";
                    $stmt = $conn->conexao->prepare($sql);
        
                    if($stmt->execute()){
                        while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                            echo "<tr>
                                        <td>$rs->ID</td>
                                        <td>$rs->Nome</td>
                                        <td>$rs->Usuario</td>
                                        <td>
                                            <form method = 'POST'>
                                                <input type='hidden' name='remover' value='$rs->ID'>
                                                <input type='submit' value='Remover' class='btn btn-dark' >
                                            </form>
                                        </td>
                                    </tr>";
                        }
                    }else{
                        echo "Erro na recuperação de dados";
                    }
        
                    if(isset($_POST['remover'])) {
                        // Obtém o ID do usuário a ser removido
                        $remove_id = $_POST['remover'];
        
                        // Prepara e executa a consulta de exclusão
                        $sql_delete = "DELETE FROM users WHERE ID = ?";
                        $stmt_delete = $conn->conexao->prepare($sql_delete);
                        $stmt_delete->bindParam(1, $remove_id);
        
                        if($stmt_delete->execute()) {
                            echo "Usuário removido com sucesso!";
                        } else {
                            echo "Erro ao remover usuário.";
                        }
                    }
                    if(isset($_POST["remove-all"])){
                        $sql_delete_all = "DELETE FROM users";
                        $stmt_delete_all = $conn->conexao->prepare($sql_delete_all);
                        if($stmt_delete_all->execute()){
                            echo "Todos os usuarios foram removidos com sucesso";
                        }
                        else{
                            echo "Erro na remoção";
                        }
                    }
                ?>
        
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuario</th>
                    <th><form method="POST"><input type="submit" value="Remover Todos" name="remove-all" id="remove-all" class="btn btn-dark"></form></th>
                </tr>
        
            </tfoot>
        
        </table>
        <h3>Atualize a tabela para ver as alterações <a href="login.php"><input type="button" value="Atualizar" class="btn btn-dark"></a></h3>
    </main>
</body>
</html>