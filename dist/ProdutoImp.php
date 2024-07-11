<?php
require_once('conexao.php'); // Incluir o arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $novoProduto = $_POST['nome'];
    $novoValor = $_POST['valor'];

    // Verifica se o produto já existe
    $queryVerifica = "SELECT * FROM produtos WHERE nomeProduto = '$novoProduto'";
    $resultVerifica = $conexao->query($queryVerifica);

    if ($resultVerifica->num_rows > 0) {
        echo "Produto já existe!";
    } else {
        // Insere o novo produto se ele não existe
        $queryCadastrar = "INSERT INTO produtos (nomeProduto, imagemProduto, precoProduto) VALUES ('$novoProduto', '', '$novoValor')";
        
        if ($conexao->query($queryCadastrar) === TRUE) {
            echo "<script>alert('Produto adicionado com sucesso!')</script>";
        } else {
            echo "Erro ao adicionar produto: " . $conexao->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <style>


        body {
            font-family: Arial, sans-serif;
            background-color: #ffccdd; /* Cor de fundo rosa claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
        text-transform: uppercase;
        color: #ff1493; /* Cor rosa choque */
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
<div>
<h2 class="text-center">CATÁLOGO</h2>
<label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required><br><br>
    
    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required><br><br>
    
    <!--<label for="imagem">Imagem do Produto:</label>
    <input type="file" id="imagem" name="imagem" accept="image/*"><br><br>-->
    
    <input type="submit" value="Cadastrar">
    <a href="excluir.php">Excluir</a>
    <a href="http://localhost:8080/PROJETOFINALPHP/ecommerce/dist/index.php">Voltar</a>
    </div>
</form>

</body>
</html>
