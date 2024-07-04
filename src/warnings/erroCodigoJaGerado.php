<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Erro</title>
    <!-- Inclui Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
            padding: 20px;
        }

        .error-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            text-align: center;
        }

        .error-title {
            color: #0a408a;
            margin-bottom: 20px;
            font-size: 36px;
            font-weight: bold;
        }

        .error-message {
            color: #555555;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .btn-secondary {
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 6px;
            background-color: #0a408a;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #555555;
        }

        /* Estilos para dispositivos móveis */
        @media (max-width: 576px) {
            .error-container {
                padding: 20px;
            }

            .error-title {
                font-size: 28px;
            }

            .error-message {
                font-size: 16px;
            }

            .btn-secondary {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container error-container">
        <div class="row">
            <div class="col-12">
                <img src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo" class="img-fluid mb-4" style="max-width: 100%;">
            </div>
            <div class="col-12">
                <h1 class="error-title">Você já está cadastrado</h1>
                <span class="error-message"><?php if ($error) echo $error; ?></span>
                <p class="error-message">Visite a loja para resgatar seu desconto.</p>
            </div>
            <div class="col-12">
                <button class="btn btn-secondary" onclick="goBack()">Voltar</button>
            </div>
        </div>
    </div>
    
    <!-- Inclui Bootstrap JS e dependências do Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function goBack() {
            window.history.back(); // Volta para a página anterior
        }
    </script>
</body>
</html>
