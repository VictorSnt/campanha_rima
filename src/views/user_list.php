<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de inscritos</h1>
        <div class="row">
            <?php
            foreach ($users as $user) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($user["full_name"]) . '</h5>
                            <p class="card-text"><strong>CPF:</strong> ' . htmlspecialchars($user["cpf"]) . '</p>
                            <p class="card-text"><strong>Telefone:</strong> ' . htmlspecialchars($user["phone"]) . '</p>
                            <p class="card-text"><strong>Código de Desconto:</strong> ' . htmlspecialchars($user["discount_code"]) . '</p>
                            <p class="card-text"><strong>Data de Criação:</strong> ' . htmlspecialchars($user["created_at"]) . '</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
