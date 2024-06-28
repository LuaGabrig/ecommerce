<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            margin-bottom: 20px; /* Espaço entre os formulários */
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: pink;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
        }

        .login-form input[type="submit"]:hover {
            background-color: #ff1493; /* Tonalidade mais escura de rosa */
        }

        .login-form p {
            margin-bottom: 10px;
        }

        .error-message {
            color: #f44336;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <form action="processa_login.php" method="post">
        <p>Nome de Usuário <input type="text" name="usuario" required></p>
        <p>Senha <input type="password" name="senha" required></p>
        <input type="submit" value="Entrar" name="entrar">
    </form>
</div>

<div class="login-form">
    <form action="cadastro.php" method="post">
        <button class="btn btn-rosa btn-block" type="submit">Cadastrar</button>
    </form>
</div>

<?php
// Exibe a mensagem de erro de login, se houver
if (isset($erro_login)) {
    echo "<p class='error-message'>$erro_login</p>";
}
?>
</body>
</html>
