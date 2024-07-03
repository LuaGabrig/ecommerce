<?php 
require_once('conexao.php');

// Variável para mensagem de sucesso
$msg_sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $banco = "dbluana";

    // Cria a conexão
    $conn = new mysqli($servidor, $username, $senha, $banco);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Validar e limpar os dados do formulário
    $nome = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : '';
    $senha = isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : '';

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($telefone) || empty($senha)) {
        echo "Todos os campos são obrigatórios.";
    } else {
        // Verifica se o e-mail já está cadastrado
        $sql_check_email = "SELECT * FROM cliente WHERE email = '$email'";
        $result_check_email = $conn->query($sql_check_email);

        if ($result_check_email && $result_check_email->num_rows > 0) {
            echo "Este e-mail já está cadastrado.";
        } else {
            // Prepara a consulta SQL com statement
            $stmt = $conn->prepare("INSERT INTO cliente (nome, email, telefone, senha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nome, $email, $telefone, $senha);

            // Executa a consulta
            if ($stmt->execute()) {
                $msg_sucesso = "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
            }

            // Fecha a conexão
            $stmt->close();
        }
    }

    // Fecha a conexão principal
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionais que não estão no Bootstrap */
        body {
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        
        /* Estilo personalizado para o botão rosa */
        .btn-rosa {
            background-color: #ff69b4;
            color: #fff;
        }
        
        .btn-rosa:hover {
            background-color: #e64999;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Cadastro de Usuário</h1>

    <!-- Mostrar mensagem de sucesso se houver -->
    <?php if (!empty($msg_sucesso)): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $msg_sucesso; ?>
    </div>
    <a href="index.php" class="btn btn-primary">Voltar para a página inicial</a>
    <?php else: ?>
    <form class="needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
        <div class="mb-3">
            <label for="usuario">Nome de Usuário:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
            <div class="invalid-feedback">
                Por favor, insira um nome de usuário.
            </div>
        </div>
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                Por favor, insira um email válido.
            </div>
        </div>
        <div class="mb-3">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
            <div class="invalid-feedback">
                Por favor, insira um número de telefone.
            </div>
        </div>
        <div class="mb-3">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <div class="invalid-feedback"></div>
        </div>
        <button class="btn btn-rosa btn-block" type="submit">Cadastrar</button>
    </form>
    <?php endif; ?>
</body>
</html>
