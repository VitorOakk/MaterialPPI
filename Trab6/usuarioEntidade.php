<?php
class usuarioEntidade{
    private $user;
    private $password;
    private $nome;

    public function getUser(){
        return $this->$user;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getName(){
        return $this->nome;
    }
    public function setName($nome){
        $this->nome = $nome;
    }
}
?>
