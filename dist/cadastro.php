<?php 
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados (substitua pelos seus dados de conexão)
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara os dados para inserção
    $usuario = $_POST['usuario'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // SQL para inserir os dados
    $sql = "INSERT INTO usuarios (usuario, sobrenome, email, senha)
            VALUES ('$usuario', '$sobrenome', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão
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

    <form class="needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
        <div class="mb-3">
            <label for="usuario">Nome de Usuário:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
            <div class="invalid-feedback">
                Por favor, insira um nome de usuário.
            </div>
        </div>
        <div class="mb-3">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            <div class="invalid-feedback">
                Por favor, insira o sobrenome.
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
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <div class="invalid-feedback">
                Por favor, insira uma senha.
            </div>
        </div>
        <button class="btn btn-rosa btn-block" type="submit">Cadastrar</button>
    </form>

    <!-- Scripts do Bootstrap (opcional, caso precise de funcionalidades extras do Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
