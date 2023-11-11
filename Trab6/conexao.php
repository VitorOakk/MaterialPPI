<?php
class Conexao {
    public $conexao;

    function __construct() {
        if (!isset($this->conexao)) {
            try {
                $this->conexao = new PDO('mysql:host=sql107.infinityfree.com;dbname=if0_34798528_teste;port=3306', 'if0_34798528', 'j8PXBoeUHI');
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    function fecharConexao(){
        if (isset($this->conexao)) {
            $this->conexao = null;
        }
    }
}
?>