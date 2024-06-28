<?php

class Conexao {

    private $servidor, $usuario, $senha, $banco, $conn;

    public function __construct($servidor, $usuario, $senha, $banco)
    {
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->banco = $banco;
        
        $this->conn = new mysqli($this->servidor, $this->usuario,$this->senha, $this->banco);




    }

        public function conectar(){
            return $this->conn;
        }
}