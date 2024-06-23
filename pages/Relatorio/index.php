<?php
include '../Login/session_check.php';

// Verifica se o usuário está logado e obtém o cargo do usuário
$cargo_usuario = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : '';
?>

<?php if ($_SESSION['cargo'] === 'Gerente') { ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StockMate | Estoque</title>

        <!-- Font [Noto Sans] -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">

        <!-- Font [Kanit] -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Custom Style -->
        <link rel="stylesheet" href="../../styles/custom.css">

        <!-- Style -->
        <link rel="stylesheet" href="./styles.css">

        <!-- Global CSS -->
        <link rel="stylesheet" href="../../styles/global.css">

        <script>
            document.getElementById('button-addon2').addEventListener('click', function () {
                var reportType = document.getElementById('reportType').value;
                var financeiroReport = document.getElementById('financeiroReport');
                var estoqueReport = document.getElementById('estoqueReport');

                if (reportType == "2") {
                    financeiroReport.style.display = "block";
                    estoqueReport.style.display = "none";
                } else if (reportType == "1") {
                    financeiroReport.style.display = "none";
                    estoqueReport.style.display = "block";
                } else {
                    financeiroReport.style.display = "none";
                    estoqueReport.style.display = "none";
                }
            });
        </script>

    </head>

    <body>
        <!-- NAVBAR -->
        <div class="container-fluid bg-primary navbar-shadow">
            <nav class="container">
                <div class="row d-flex align-items-center py-3">

                    <!-- MENU -->
                    <div class="d-block d-lg-none col-3">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="bi bi-list fs-1 text-white"></i>
                        </button>
                    </div>
                    <!------->

                <!-- LOGO -->
                    <div class="col-6 col-lg-2">
                        <img src="../../images/logo_stock_mate.png" alt="Logo Stock Mate" class="img-fluid">
                    </div>
                    <!------->

                <!-- NAVIGATION -->
                    <div class="d-none d-lg-block col-9">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link text-white nav-font" href="../estoque">Estoque</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white nav-font" href="../entrada">Entrada</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white nav-font" href="../saida">Saída</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white nav-font" href="../fornecedor">Fornecedores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white nav-font" href="../cliente">Clientes</a>
                            </li>
                            <?php
                            // Verificar o cargo do usuário para exibir ou ocultar itens do menu
                            if ($_SESSION['cargo'] === 'Gerente') { ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white nav-font" href="../colaborador">Colaboradores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white nav-font selected" href="../relatorio">Relatórios</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!------->

                <!-- SAIR -->
                    <div class="col-3 col-lg-1 text-end">
                        <div class="dropdown-center">
                            <button class="btn rounded-circle border-0 p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#alterarSenhaModal">
                                        Alterar senha
                                    </button>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../logoff.php">
                                        Sair
                                        &#8287;&#8287;&#8287;
                                        <i class="bi bi-box-arrow-right text-primary"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!------->
            </div>
        </nav>

        <div class="collapse container d-lg-none" id="navbarToggleExternalContent">
            <ul class="nav d-flex flex-column">
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../estoque">Estoque</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../entrada">Entrada</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../saida">Saída</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../fornecedor">Fornecedores</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../cliente">Clientes</a>
                </li>
                <?php
                // Verificar o cargo do usuário para exibir ou ocultar itens do menu
                if ($_SESSION['cargo'] === 'Gerente') { ?>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../colaborador">Colaboradores</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font selected" href="../relatorio">Relatórios</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!------->

    <!--RELATORIOS-->
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-5"></div>

                <div class="form-floating">
                    <form method="post" action="">
                        <div class="input-group">
                            <select class="form-select shadow-none" id="reportType" name="reportType">
                                <option disabled selected>Tipos</option>
                                <option value="1">Estoque</option>
                                <option value="2">Financeiro</option>
                            </select>
                            <button class="btn btn-primary" type="submit" id="button-addon2">Selecionar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-3"></div>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reportType'])) {
                $reportType = $_POST['reportType'];

                if ($reportType == "2") {
                    echo '<div id="financeiroReport" class="col-12 mt-3">';
                    echo '<iframe title="stock_mate_pi" width="100%" height="650" 
                    src="https://app.powerbi.com/view?r=eyJrIjoiYWUxNjRjOGYtMGMzNC00NTU2LWJkOGItYWQ4NGVmNGM1M2IwIiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9" 
                        frameborder="0" allowFullScreen="true"></iframe>';
                    echo '</div>';
                } elseif ($reportType == "1") {
                    echo '<div id="estoqueReport" class="col-12 mt-3">';
                    include "../../classes/Relatorio/relatorio.php";
                    echo '</div>';
                }
            } else {
                echo '<div id="estoqueReport" class="col-12 mt-3">';
                include "../../classes/Relatorio/relatorio.php";
                echo '</div>';
            }
            ?>
        </div>
        <!--fim do RELATORIO-->
        <!-- ALTERAR SENHA -->
        <div class="modal fade" id="alterarSenhaModal" tabindex="-1" aria-labelledby="alterarSenhaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="alterarSenhaModalLabel">Alterar Senha</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container" method="post"
                            action="../../classes/Cliente/cliente.controller.php?acao=inserir">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" type="password" id="senhaAtual" name="senhaAtual" pti
                                            placeholder="Senha Atual">
                                        <label for="senhaAtual">Senha Atual</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" type="password" id="novaSenha" name="novaSenha"
                                            placeholder="Senha Nova" disabled>
                                        <label for="novaSenha">Senha Nova</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" type="password" id="confirmarSenhaNova"
                                            name="confirmarSenhaNova" placeholder="Confirme a Senha Nova" disabled>
                                        <label for="confirmarSenhaNova">Confirme a Senha Nova</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-primary">Alterar Senha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------->

    <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>

        <!-- Script -->
        <script src="../../js/script.js"></script>
    </body>

    </html>

<?php } else {
    header("Location: ../Login/index.php");
} ?>