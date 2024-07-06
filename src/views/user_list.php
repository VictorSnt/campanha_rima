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
    <title>Usuários</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #91c9ff;
            max-height: fit-content;
            background-repeat: no-repeat;
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
            background-color: #00d757;
            height: 128px;
            width: 128px;
            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;
            border-radius: 50%;
            transition: all .5s ease;
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
<nav class="bg-white">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.
            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.
            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <img class="h-8 w-auto" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo construfacil">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="https://grupoconstrufacil.com.br/" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Home</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-900 hover:text-white"></a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-900 hover:text-white"></a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-900 hover:text-white"></a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- Profile dropdown -->
        <div class="relative ml-3 group">
          <div>
            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://www.hotelbooqi.com/wp-content/uploads/2021/12/128-1280406_view-user-icon-png-user-circle-icon-png.png" alt="user icon">
            </button>
          </div>

          <!-- Dropdown menu -->
          <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0 group-hover:opacity-100 group-hover:scale-100 transform scale-95 transition ease-out duration-100" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="/new_campanha_rima/auth/logout" class="block px-4 py-2 text-sm text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-2">log out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="hidden sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="https://grupoconstrufacil.com.br/" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Home</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"></a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"></a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"></a>
    </div>
  </div>
</nav>

    <div class="ag-format-container mt-5">
        <div class="ag-courses_box">
            <?php if (isset($args['users'])): ?>
                <?php foreach ($args['users'] as $user): ?>
                    <?php
                        $formatedPhone = str_replace(array('(', ')', ' ', '-'), '', $user->phone);
                    ?>
                    <div class="ag-courses_item">
                        <a href="https://api.whatsapp.com/send?phone=<?php echo urlencode($formatedPhone); ?>" class="ag-courses-item_link">
                            <div width="100" class="ag-courses-item_bg"></div>
                            <div class="ag-courses-item_title"><i class="fa-solid fa-user"></i> <?= htmlspecialchars($user->full_name) ?></div>
                            <div class="ag-courses-item_date-box">
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-calendar"></i> Inscrito em</strong> <?= htmlspecialchars($user->created_at) ?></p>
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-phone"></i> Contato</strong> <?= htmlspecialchars($user->phone) ?></p>
                                <p class="ag-courses-item_date"><strong><i class="fa-solid fa-tag"></i> codigo</strong> <?= htmlspecialchars($user->discount_code) ?></p>
                            </div>
                            <?php if (!$user->notified) : ?>
                                <button onclick="goToWhatsapp(this)" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                                Whatsapp <i class="fab fa-whatsapp"></i>
                                </button>
                                <form method="post" action="/new_campanha_rima/admin/customer_notified">
                                    <input type="hidden" name="csrf_token" value="<?php echo $token ?>">
                                    <input type="hidden" name="cpf" value="<?php echo $user->cpf ?>" >
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                                    Ofertas Enviadas!
                                    </button>
                                </form>
                            <?php endif ?>
                        </a>
                        
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-700">Nenhum usuário encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- Paginação -->
        <?php if (isset($args['totalPages'])): ?>
        <div class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="?page=<?= max(1, $args['currentPage'] - 1) ?>" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 <?= ($args['currentPage'] == 1) ? 'disabled' : '' ?>">Anterior</a>
            <a href="?page=<?= min($args['totalPages'], $args['currentPage'] + 1) ?>" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 <?= ($args['currentPage'] == $args['totalPages']) ? 'disabled' : '' ?>">Próximo</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
            <p class="text-sm text-gray-700">
                Mostrando
                <span class="font-medium"><?= (($args['currentPage'] - 1) * $_ENV['RESULTS_PER_PAGE']) + 1 ?></span>
                até
                <span class="font-medium"><?= min($args['currentPage'] * $_ENV['RESULTS_PER_PAGE'], $args['totalResults']) ?></span>
                de
                <span class="font-medium"><?= $args['totalResults'] ?></span>
                resultados
            </p>
            </div>
            <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <a href="?page=<?= max(1, $args['currentPage'] - 1) ?>" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 <?= ($args['currentPage'] == 1) ? 'disabled' : '' ?>">
                <span class="sr-only">Anterior</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>
                </a>
                <?php for ($i = 1; $i <= $args['totalPages']; $i++): ?>
                <a href="?page=<?= $i ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold <?= ($args['currentPage'] == $i) ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' ?>"><?= $i ?></a>
                <?php endfor; ?>
                <a href="?page=<?= min($args['totalPages'], $args['currentPage'] + 1) ?>" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 <?= ($args['currentPage'] == $args['totalPages']) ? 'disabled' : '' ?>">
                <span class="sr-only">Próximo</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
                </a>
            </nav>
            </div>
        </div>
        </div>
        <?php endif; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            } else {
            mobileMenu.classList.add('hidden');
            }

            this.querySelectorAll('svg').forEach(function(svg) {
            svg.classList.toggle('hidden');
            svg.classList.toggle('block');
            });
        });
</script>
<script>
    function goToWhatsapp(button) {
        // Encontra o elemento <a> mais próximo do botão clicado
        var closestLink = button.closest('.item').querySelector('a');

        // Se um link for encontrado, redireciona para o href do link
        if (closestLink) {
            window.location.href = closestLink.href;
        }
    }
</script>
</body>
</html>
