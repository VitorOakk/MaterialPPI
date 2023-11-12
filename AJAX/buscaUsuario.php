<?php
require_once "conexao.php";


    $usuario = $_POST["text"];
    $sql = "SELECT * FROM users WHERE Usuario = :usuario";

    $conn = new Conexao();
    
    $stmt = $conn->conexao->prepare($sql);
    $stmt->bindValue(":usuario", $usuario);
    $res = $stmt->execute();

    if ($res) {
        $total = $stmt->rowCount();
        while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
            $nome = $rs->Nome;
            $senha = $rs->Senha;
            $data[] = array("Nome" => $nome, "Usuario" => $usuario, "Senha" => $senha);
            
        }
        if ($total > 0) {
            echo json_encode(array("success" => true, "total" => $total, "data" => $data));                
        } else {
            echo json_encode(array("success" => true, "total" => 0));
        }
        
    } else {
        $mensagem = "Erro ao executar a consulta";
        echo json_encode(array("success" => false, "Mensagem" => $mensagem));
    }
