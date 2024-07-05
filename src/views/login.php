<?php
  error_reporting(0);
  $token = bin2hex(random_bytes(32));
  $_SESSION['csrf_token'] = $token;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Raleway:400,700");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        .error-message {
            color: #ff0000; /* Cor vermelha para destacar o erro */
            background-color: #ffe6e6; /* Fundo levemente vermelho */
            border: 1px solid #ff0000; /* Borda vermelha */
            padding: 10px 15px; /* Espaçamento interno */
            margin: 10px 0; /* Espaçamento externo */
            border-radius: 5px; /* Canto arredondado */
            font-weight: bold; /* Texto em negrito */
            text-align: center; /* Centralizar o texto */
            font-size: 14px; /* Tamanho da fonte */
        }

        body {
            background: linear-gradient(280deg, #b7d3f5, #0f3e7f);
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .screen {
            background: linear-gradient(90deg, #45668f, #0f3e7f);
            position: relative;
            height: 600px;
            width: 360px;
            box-shadow: 0px 0px 24px #0f3e7f;
        }

        .screen__content {
            z-index: 1;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            -webkit-clip-path: inset(0 0 0 0);
            clip-path: inset(0 0 0 0);
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #fff;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #1b509a;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .login {
            width: 100%;
            padding: 30px;
            padding-top: 156px;
        }

        .login__field {
            padding: 20px 0px;
            position: relative;
            width: 100%;
        }

        .login__icon {
            position: absolute;
            top: 30px;
            color: #7875b5;
        }

        .login__input {
            border: none;
            border-bottom: 2px solid #d1d1d4;
            background: none;
            padding: 10px;
            padding-left: 24px;
            font-weight: 700;
            width: 100%;
            transition: 0.2s;
        }

        .login__input:active,
        .login__input:focus,
        .login__input:hover {
            outline: none;
            border-bottom-color: #0f3e7f;
        }

        .login__submit {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #d4d3e8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #0f3e7f;
            box-shadow: 0px 2px 2px #0d3c7f;
            cursor: pointer;
            transition: 0.2s;
        }

        .login__submit:active,
        .login__submit:focus,
        .login__submit:hover {
            border-color: #12468f;
            outline: none;
        }

        .button__icon {
            font-size: 24px;
            margin-left: auto;
            color: #0f3e7f;
        }

        .social-login {
            position: absolute;
            height: 140px;
            width: 160px;
            text-align: center;
            bottom: 0px;
            right: 0px;
            color: #fff;
        }

        .social-icons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-login__icon {
            padding: 20px 10px;
            color: #fff;
            text-decoration: none;
            text-shadow: 0px 0px 8px #0f3e7f;
        }

        .social-login__icon:hover {
            transform: scale(1.5);
        }

        @media (max-width: 768px) {
            .screen {
                width: 100%;
                height: 100%;
                box-shadow: none;
            }

            .login {
                padding-top: 50px;
            }

            .screen__background__shape1,
            .screen__background__shape2,
            .screen__background__shape3,
            .screen__background__shape4 {
                display: none;
            }

            .login__icon {
                top: 20px;
            }

            .login__input {
                padding: 8px;
            }

            .login__submit {
                margin-top: 20px;
                padding: 12px 16px;
            }
        }

        @media (max-width: 480px) {
            .login__field {
                padding: 10px 0;
            }

            .login__input {
                font-size: 14px;
                padding: 8px 16px;
            }

            .login__submit {
                font-size: 12px;
                padding: 10px 14px;
            }

            .button__icon {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <img width="300" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo Promoção">
                <?php if (isset($_GET['error'])) : ?>
                <p class="error-message"><?php echo $_GET['error']; ?></p>
                <?php endif ?>
                <form class="login" method="post" action="/new_campanha_rima/auth/login">
                    
                    <input type="hidden" name="csrf_token" value="<?php echo $token ?>">
                    
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" name="username" placeholder="Usuario / Email">
                    </div>
                    
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" placeholder="Senha">
                    </div>
                    
                    <button class="button login__submit">
                        <span class="button__text">Entrar</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>
</html>