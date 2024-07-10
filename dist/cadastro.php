<?php
require_once('conexao.php'); // Arquivo de conexão com o banco de dados

$msg_erro = ''; // Mensagem de erro inicialmente vazia
$msg_sucesso = ''; // Mensagem de sucesso inicialmente vazia

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e limpar os dados do formulário
    $nome = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : '';

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        $msg_erro = "Todos os campos são obrigatórios.";
    } else {
        // Verifica se o e-mail já está cadastrado usando prepared statement
        $sql_check_email = "SELECT * FROM cadastro_usuario WHERE email = ?";
        $stmt_check_email = $conexao->prepare($sql_check_email);
        
        if ($stmt_check_email) {
            $stmt_check_email->bind_param("s", $email);
            $stmt_check_email->execute();
            $result_check_email = $stmt_check_email->get_result();

            if ($result_check_email->num_rows > 0) {
                $msg_erro = "Este e-mail já está cadastrado.";
            } else {
                // Insere o novo usuário usando prepared statement
                $sql_insert = "INSERT INTO cadastro_usuario (nomeCompleto, email, senha) VALUES (?, ?, ?)";
                $stmt_insert = $conexao->prepare($sql_insert);

                if ($stmt_insert) {
                    $stmt_insert->bind_param("sss", $nome, $email, $senha);
                    
                    if ($stmt_insert->execute()) {
                        $msg_sucesso = "Cadastro realizado com sucesso!";
                    } else {
                        $msg_erro = "Erro ao cadastrar usuário: " . $stmt_insert->error;
                    }
                    
                    $stmt_insert->close();
                } else {
                    $msg_erro = "Erro na preparação da consulta: " . $conexao->error;
                }
            }

            $stmt_check_email->close();
        } else {
            $msg_erro = "Erro na preparação da consulta: " . $conexao->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
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

    <?php if (!empty($msg_sucesso)): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $msg_sucesso; ?>
    </div>
    <a href="index.php" class="btn btn-primary">Voltar para a página inicial</a>
    <?php endif; ?>

    <?php if (!empty($msg_erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $msg_erro; ?>
    </div>
    <?php endif; ?>

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
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <div class="invalid-feedback"></div>
        </div>
        <button class="btn btn-rosa btn-block" type="submit">Cadastrar</button>
    </form>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
