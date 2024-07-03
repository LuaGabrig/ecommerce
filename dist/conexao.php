<?php

// Classe para gerenciar a conexão com o banco de dados
class Conexao {
    public $conn;

    public function __construct($servidor, $usuario, $senha, $banco) {
        $this->conn = new mysqli($servidor, $usuario, $senha, $banco);

        if ($this->conn->connect_error) {
            die("Erro na conexão: " . $this->conn->connect_error);
        }
    }

    public function getConn() {
        return $this->conn;
    }
}

// Configurações de conexão
$servidor = 'localhost';
$username = 'root';
$senha = '';
$banco = 'dbluana';

// Criação da conexão usando a classe Conexao
$conexao = new Conexao($servidor, $username, $senha, $banco);
$conn = $conexao->getConn(); // Obtém a conexão

// Verifica se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}