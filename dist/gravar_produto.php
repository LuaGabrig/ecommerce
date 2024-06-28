
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

// Exibe o formulário de cadastro
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required><br><br>
    
    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required><br><br>
    
    <label for="imagem">URL da Imagem:</label>
    <input type="text" id="imagem" name="imagem" required><br><br>
    
    <input type="submit" value="Cadastrar">
    <a href="http://localhost:8080/PROJETOFINALPHP/ecommerce/dist/index.html">Voltar</a>
</form>

<?php
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
?>
</body>
</html>
