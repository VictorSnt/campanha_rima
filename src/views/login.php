<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0a408a;
            color: #5f5f5f;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 50px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo {
            width: 300px;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #0a408a;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #063267;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo" class="logo">
        <h3>INSIRA SUAS CREDENCIAIS</h3>
        <form action="/campanha_rima/login_user" method="post">
            
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Digite seu nome de usuário">
            </div>
            
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Digite sua senha">
            </div>
            
            <div class="form-group">
                <button type="submit">Entrar</button>
            </div>
            
        </form>
    </div>
</body>
</html>
