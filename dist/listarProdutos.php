<?php
require_once("conexao.php");

// Verifica se foi enviado um filtro de ordenação
$ordenacao = isset($_GET['ordenacao']) ? $_GET['ordenacao'] : 'nome'; // Padrão para ordenar por nome

// Consulta SQL para recuperar os produtos com base na ordenação escolhida
switch ($ordenacao) {
    case 'menor_preco':
        $sql = "SELECT nomeProduto, imagemProduto, precoProduto FROM produtos ORDER BY precoProduto ASC";
        break;
    case 'maior_preco':
        $sql = "SELECT nomeProduto, imagemProduto, precoProduto FROM produtos ORDER BY precoProduto DESC";
        break;
    default:
        $sql = "SELECT nomeProduto, imagemProduto, precoProduto FROM produtos ORDER BY nomeProduto";
}

$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo de Produtos</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Roboto', Arial, sans-serif;
        background-color: #f8f1f1; /* Cor de fundo rosa claro */
        color: #333; /* Cor do texto */
        text-align: center; /* Alinhamento central */
        padding-top: 20px;
        background-image: url('assets/floral-background.jpg'); /* Imagem de fundo floral */
        background-size: cover;
        margin: 0;
    }

    .container {
        max-width: 900px; /* Largura máxima do conteúdo */
        margin: 0 auto; /* Centraliza o conteúdo */
        padding: 20px; /* Espaçamento interno */
    }

    h1 {
        color: #e6005c; /* Cor rosa mais forte para o título */
        margin-bottom: 20px;
    }

    .ordenacao {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .ordenacao a {
        text-decoration: none;
        color: #333;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #e6005c; /* Cor de fundo rosa para os links */
        transition: background-color 0.3s ease; /* Transição suave da cor de fundo */
    }

    .ordenacao a:hover {
        background-color: #c40052; /* Cor de fundo mais escura ao passar o mouse */
    }

    .ordenacao a.active {
        font-weight: bold;
        color: #fff; /* Texto branco para o link ativo */
        background-color: #9b003f; /* Cor de fundo mais escura para o link ativo */
    }

    .catalogo {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px; /* Espaço entre os produtos */
    }

    .produto {
        border: 1px solid #e6b3b3; /* Borda rosa claro */
        background-color: #fff; /* Fundo branco */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra suave */
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transições suaves */
    }

    .produto:hover {
        transform: translateY(-5px); /* Efeito de levantamento ao passar o mouse */
        box-shadow: 0 8px 16px rgba(0,0,0,0.2); /* Sombra mais intensa */
    }

    .produto img {
        max-width: 100%;
        height: auto;
        border-radius: 10px 10px 0 0; /* Cantos arredondados apenas na parte superior */
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Sombra leve */
        margin-bottom: 10px;
        transition: transform 0.3s ease; /* Transição suave */
    }

    .produto:hover img {
        transform: scale(1.05); /* Efeito de escala ao passar o mouse */
    }

    .produto h2 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #e6005c; /* Cor rosa mais forte para o título */
    }

    .produto p {
        font-size: 16px;
        margin-top: 8px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Catálogo de Produtos</h1>

        <div class="ordenacao">
            <a href="?ordenacao=nome" class="<?= ($ordenacao == 'nome' ? 'active' : '') ?>">Nome</a>
            <a href="?ordenacao=menor_preco" class="<?= ($ordenacao == 'menor_preco' ? 'active' : '') ?>">Menor Preço</a>
            <a href="?ordenacao=maior_preco" class="<?= ($ordenacao == 'maior_preco' ? 'active' : '') ?>">Maior Preço</a>
        </div>

        <div class="catalogo">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='produto'>";
                    echo "<img src='assets/images/" . $row['imagemProduto'] . "' alt='" . $row['nomeProduto'] . "'>";
                    echo "<h2>" . $row['nomeProduto'] . "</h2>";
                    echo "<p><strong>Preço: R$" . number_format($row['precoProduto'], 2, ',', '.') . "</strong></p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Não há produtos para exibir.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conexao->close();
?>
