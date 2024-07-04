<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #91c9ff;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #093f89;
            color: #FFF;
            border: 1px solid #121212;
            margin: 0 4px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .pagination-link:hover {
            background-color: #3b3b3b;
            border-color: #3b3b3b;
        }
        .pagination-link.active {
            background-color: #fdeb6f;
            color: #121212;
            border-color: #f9b234;
        }
        .pagination-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .ag-format-container {
            max-height: 100%;
            overflow-y: auto;
            margin: 0 auto;
        }
        .ag-courses_box {
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 50px 0;
        }
        .ag-courses_item {
            flex-basis: calc(33.33333% - 30px);
            margin: 0 15px 30px;
            overflow: hidden;
            border-radius: 28px;
        }
        .ag-courses-item_link {
            display: block;
            padding: 30px 20px;
            background-color: #093f89;
            overflow: hidden;
            position: relative;
        }
        .ag-courses-item_link:hover,
        .ag-courses-item_link:hover .ag-courses-item_date {
            text-decoration: none;
            color: #FFF;
        }
        .ag-courses-item_link:hover .ag-courses-item_bg {
            transform: scale(10);
        }
        .ag-courses-item_title {
            min-height: 87px;
            margin: 0 0 25px;
            overflow: hidden;
            font-weight: bold;
            font-size: 30px;
            color: #FFF;
            z-index: 2;
            position: relative;
        }
        .ag-courses-item_date-box {
            font-size: 18px;
            color: #FFF;
            z-index: 2;
            position: relative;
        }
        .ag-courses-item_date {
            font-weight: bold;
            color: #fdeb6f;
            transition: color .5s ease;
        }
        .ag-courses-item_bg {
            height: 128px;
            width: 128px;
            background-color: #f9b234;
            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;
            border-radius: 50%;
            transition: all .5s ease;
        }
        .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
            background-color: #3ecd5e;
        }
        .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
            background-color: #e44002;
        }
        .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
            background-color: #952aff;
        }
        .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
            background-color: #cd3e94;
        }
        .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
            background-color: #4c49ea;
        }
        @media only screen and (max-width: 979px) {
            .ag-courses_item {
                flex-basis: calc(50% - 30px);
            }
            .ag-courses-item_title {
                font-size: 24px;
            }
        }
        @media only screen and (max-width: 767px) {
            .ag-format-container {
                width: 96%;
            }
        }
        @media only screen and (max-width: 639px) {
            .ag-courses_item {
                flex-basis: 100%;
            }
            .ag-courses-item_title {
                min-height: 72px;
                line-height: 1;
                font-size: 24px;
            }
            .ag-courses-item_link {
                padding: 22px 40px;
            }
            .ag-courses-item_date-box {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="ag-format-container mt-5">
        <img width="200" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo Promoção">
        <div class="ag-courses_box">
            <?php if (isset($users)): ?>
                <?php foreach ($users as $user): ?>
                    <div class="ag-courses_item">
                        <a href="#" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>
                            <div class="ag-courses-item_title"><i class="fa-solid fa-user"></i> <?= htmlspecialchars($user->full_name) ?></div>
                            <div class="ag-courses-item_date-box">
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-calendar"></i> Inscrito em</strong> <?= htmlspecialchars($user->created_at) ?></p>
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-phone"></i> Contato</strong> <?= htmlspecialchars($user->phone) ?></p>
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-tag"></i> codigo</strong> <?= htmlspecialchars($user->discount_code) ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-700">Nenhum usuário encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Paginação -->
        <?php if (isset($totalPages)): ?>
        <nav aria-label="Page navigation" class="pagination">
            <ul class="inline-flex">
                <li class="pagination-link <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a href="?page=<?= $currentPage - 1 ?>" class="block text-center w-full">
                        &laquo; Anterior
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="pagination-link <?= ($currentPage == $i) ? 'active' : '' ?>">
                        <a href="?page=<?= $i ?>" class="block text-center w-full">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <li class="pagination-link <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                    <a href="?page=<?= $currentPage + 1 ?>" class="block text-center w-full">
                        Próximo &raquo;
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
</body>
</html>
