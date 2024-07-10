<?php

// Configurações de conexão
$servidor = 'localhost';
$username = 'root';
$senha = '';
$banco = 'db_loja';

// Criação da conexão usando a classe Conexao
$conexao = new mysqli($servidor, $username, $senha, $banco);

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}