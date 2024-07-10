<?php
require_once('conexao.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $novoProduto = $_POST['nome'];
    //$novaDescricao = isset($_POST['descricao']) ? $_POST['descricao'] : ''; // Pode ser vazio se não fornecido
    $novoValor = $_POST['valor'];
    //$novaImagem = $_POST['imagem']; // Obtém o nome do arquivo da imagem
    // Move o arquivo da imagem para a pasta desejada (opcional)
    //$uploadDir = 'assets/images/'; // Diretório onde as imagens serão armazenadas
    //$uploadFile = $uploadDir . basename($_POST['imagem']);


    $queryProd = "SELECT * FROM produtos WHERE nome = '$novoProduto'";
    $execProd = $conexao->query($queryProd);
    
    $queryCadastrar = "INSERT INTO produtos (nomeProduto, imagemProduto, precoProduto) VALUES ('$novoProduto', '', '$novoValor')";
    $queryExcluir = "DELETE INTO produtos (nomeProduto) VALUES ('?')";
    
    
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>

    <div class="container">
        <h1 class="text-center">Catálogo de Produtos</h1>
        
    <style>


        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px); 
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"],
        a {
            width: 100%;
            padding: 10px;
            background-color: #ff1493;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none; 
            display: inline-block;
            text-align: center;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #ff007f; 
        }
    </style>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required><br><br>
    
    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required><br><br>
    
    <!--<label for="imagem">Imagem do Produto:</label>
    <input type="file" id="imagem" name="imagem" accept="image/*"><br><br>-->
    
    <input type="submit" value="Cadastrar">
    <input type="submit" value="Excluir">
    <a href="http://localhost:8080/PROJETOFINALPHP/ecommerce/dist/index.php">Voltar</a>

</form>

</body>
</html>
