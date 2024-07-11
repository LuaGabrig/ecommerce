<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Excluir Produto</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonte moderna */
        background-color: #ffccdd; /* Cor de fundo rosa claro */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
        max-width: 400px; /* Largura máxima do conteúdo */
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
        text-transform: uppercase;
        color: #ff1493; /* Cor rosa choque */
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #ff1493; /* Cor rosa choque */
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .mensagem {
        margin-top: 10px;
        color: #333;
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Excluir Produto</h2>
    <form class="form" method="post" action="ProdutoExclu.php">
        <div class="form-group">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <button type="submit" style="background-color: #ff1493;">Excluir Produto</button>
        </div>
    </form>

    <div class="mensagem">
        <?php
        if (isset($_GET['mensagem'])) {
            echo htmlspecialchars($_GET['mensagem']);
        }
        ?>
    </div>
</div>

</body>
</html>
