<?php
   if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
    error_reporting(0);
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscrição na Promoção</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      background: linear-gradient(to bottom, #d1caca 0%, #7b7272 50%, #312f2f 100%);
      background-repeat: no-repeat;
      background-size: cover;
      margin: 0;
      height: 100vh;
    }
    .container {
      max-width: 600px;
      margin-top: 50px;
    }
    .card {
      background-image: url("https://grupoconstrufacil.com.br/campanha_rima/static/img/sunset.jpg");
      background-repeat: no-repeat; 
      background-size: cover;
      border: solid black 1px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .card-header {
      color: black;
      background-color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 20px;
    }
    .card-body {
      padding: 30px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      font-weight: bold;
      color: white;
    }
    .btn-submit {
      background-color: #137367;
      border: solid white 1px;;
      color: white;
    }
    .btn-submit:hover {
      background-color: #138496;
    }
    h3 {
      font-family: cursive;
    }
    input {
      background-color: rgba(255, 255, 255, 0.1);
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header text-center">
        <h3>
            Você 
            <img width="100" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo_rima.png" alt="Logo Rima"> 
            tem vantagens 
            <img width="100" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo Promoção">
        </h3>
      </div>
      <div class="card-body">
        <form method="POST" action="/new_campanha_rima/gerar_codigo">
        <input type="hidden" name="csrf_token" value="<?php echo $token ?>">
          
        <div class="form-group">
            <label for="nomeCompleto">Nome Completo</label>
            <input type="text" class="form-control" name="name" id="nomeCompleto" placeholder="Digite seu nome completo" required>
          </div>
          
          <div class="form-group">
            <label for="cpf">CPF</label>
            <input oninput="formatarCPF(this)" type="text" inputmode="numeric" class="form-control" name="cpf" id="cpf" maxlength="14" placeholder="Digite seu CPF" required>
          </div>
          
          <div class="form-group">
            <label for="telefone">Telefone</label>
            <input oninput="formatarTelefone(this)" type="text" inputmode="numeric" class="form-control" name="phone" id="telefone" maxlength="14" placeholder="Digite seu telefone" required>
          </div>
          <button type="submit" id="submitButton" class="btn btn-block btn-submit"><strong>Gerar Codigo</strong></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Incluindo Bootstrap JS (opcional, se precisar de funcionalidades como validação de formulário) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>.

  <script>
    function formatarCPF(input) {
      let cpf = input.value.replace(/\D/g, '');

      if (cpf.length <= 11) {
          cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
          cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
          cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      }
      input.value = cpf;
    }

    function formatarTelefone(input) {
        let telefone = input.value.replace(/\D/g, '');
        if (telefone.length <= 11) {
            telefone = telefone.replace(/(\d{2})(\d)/, '($1)$2');
            telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2');
        }
        input.value = telefone;
    }
    </script>
</body>
</html>
