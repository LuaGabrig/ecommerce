
<?php require_once("Conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

form input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: pink;
}
</style>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h1>CADASTRO DE PRODUTO</h1>

        <form action="gravar_produto.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"><br /><br />
            
            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor"><br /><br />
            
            <label for="imagem">Imagem:</label>
            <input type="text" id="imagem" name="imagem"><br /><br />
            
            <input type="submit" value="Gravar">
        </form>
    </div>
</body>

</html>
