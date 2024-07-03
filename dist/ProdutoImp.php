<?php

session_start();

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : "";
    

    // Validações básicas (você pode adicionar validações mais robustas aqui)
    if (empty($nome) || empty($valor) || empty($imagem)) {
        echo "<p>Por favor, preencha todos os campos.</p>";
    } else {
        // Cria o registro do produto e adiciona ao catálogo na sessão
        $registro = array('nome' => $nome, 'valor' => $valor, 'imagem' => $imagem);
        if (!isset($_SESSION['catalogo'])) {
            $_SESSION['catalogo'] = array();
        }
        $_SESSION['catalogo'][] = $registro;
    }
}

// Exibe a tabela com os produtos cadastrados, se houver algum
if (isset($_SESSION['catalogo']) && !empty($_SESSION['catalogo'])) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Nome</th><th>Valor</th><th>Imagem</th>";
    echo "</tr>";

    foreach ($_SESSION['catalogo'] as $linha){
        echo "<tr>";
        echo "<td>{$linha['nome']}</td>";
        echo "<td>R$ " . floatval($linha['valor']) . "</td>";
        echo "<td><img src='{$linha['imagem']}' width='250' /></td>";
        echo "</tr>";
    }

    echo "</table>";
}


class ProdutoImp {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function incluir($nome, $descricao, $preco) {
        $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssd", $nome, $descricao, $preco);
        $stmt->execute();
        return true;
    }

    public function editar($id, $nome, $descricao, $preco) {
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $nome, $descricao, $preco, $id);
        $stmt->execute();
        return true;
    }

    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
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
            width: calc(100% - 20px); /* Ajusta o tamanho para levar em conta o padding */
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
            text-decoration: none; /* Remove sublinhado do link */
            display: inline-block;
            text-align: center;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #ff007f; /* Tonalidade mais escura de rosa */
        }
    </style>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required><br><br>
    
    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required><br><br>
    
    <label for="imagem">URL da Imagem:</label>
    <input type="text" id="imagem" name="imagem" required><br><br>
    
    <input type="submit" value="Cadastrar">
    <a href="http://localhost:8080/PROJETOFINALPHP/ecommerce/dist/index.php">Voltar</a>
</form>

</body>
</html>
