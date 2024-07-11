<?php
/*

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST['nome']; // Recebe o nome do produto a ser excluído

    // Verifica se o produto existe
    $queryVerifica = "SELECT * FROM produtos WHERE nomeProduto = ?";
    $stmtVerifica = $conexao->prepare($queryVerifica);
    $stmtVerifica->bind_param('s', $nomeProduto);
    $stmtVerifica->execute();
    $resultVerifica = $stmtVerifica->get_result();

    if ($resultVerifica->num_rows > 0) {
        // O produto existe, proceder com a exclusão
        $queryExcluir = "DELETE FROM produtos WHERE nomeProduto = ?";
        $stmtExcluir = $conexao->prepare($queryExcluir);
        $stmtExcluir->bind_param('s', $nomeProduto);
        
        if ($stmtExcluir->execute()) {
            echo "<script>alert('Produto excluído com sucesso!')</script>";
        } else {
            echo "Erro ao excluir produto: " . $conexao->error;
        }

        $stmtExcluir->close();
    } else {
        // Produto não encontrado
        echo "Produto não encontrado!";
    }

    $stmtVerifica->close();
}
?>*/

require_once('ProdutoImp.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST['nome']; // Recebe o nome do produto a ser excluído

    // Verifica se o produto existe
    $queryVerifica = "SELECT * FROM produtos WHERE nomeProduto = ?";
    $stmtVerifica = $conexao->prepare($queryVerifica);
    $stmtVerifica->bind_param('s', $nomeProduto);
    $stmtVerifica->execute();
    $resultVerifica = $stmtVerifica->get_result();

    if ($resultVerifica->num_rows > 0) {
        // O produto existe, proceder com a exclusão
        $queryExcluir = "DELETE FROM produtos WHERE nomeProduto = ?";
        $stmtExcluir = $conexao->prepare($queryExcluir);
        $stmtExcluir->bind_param('s', $nomeProduto);
        
        if ($stmtExcluir->execute()) {
            $mensagem = "Produto '$nomeProduto' excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir produto: " . $conexao->error;
        }

        $stmtExcluir->close();
    } else {
        // Produto não encontrado
        $mensagem = "Produto '$nomeProduto' não encontrado!";
    }

    $stmtVerifica->close();

    // Redireciona de volta para index.php com a mensagem como parâmetro GET
    header("Location: index.php?mensagem=" . urlencode($mensagem));
    exit();
}
?>
