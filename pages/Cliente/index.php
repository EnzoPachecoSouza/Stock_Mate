<?php
$acao = 'recuperar';

require '../../classes/Cliente/cliente.controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate | Cliente</title>

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
</head>

<body>
    <!-- NAVBAR -->
    <div class="container-fluid bg-primary navbar-shadow">
        <nav class="container">
            <div class="row d-flex align-items-center py-3">

                <!-- LOGO -->
                <div class="col-2">
                    <img src="../../images/logo_stock_mate.png" alt="Logo Stock Mate" class="img-fluid">
                </div>
                <!------->

                <!-- NAVIGATION -->
                <div class="col-9">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-white nav-font selected" href="">Estoque</a>
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

                        <div class="nav-item bg-white rounded-5" style="width: 2px"></div>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Colaboradores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Relatórios</a>
                        </li>
                    </ul>
                </div>
                <!------->

                <!-- SAIR -->
                <div class="col-1 text-end">
                    <button class="btn btn-lg text-secondary nav-font">Sair</button>
                </div>
                <!------->
            </div>
        </nav>
    </div>
    <!------->

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <!-- BOTÃO DE CADASTRAR CLIENTE -->
            <div>
                <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal"
                    data-bs-target="#cadastrarClienteModal">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
            <!------->


            <!-- <div class="form-floating d-flex">
                <select class="form-select" id="catFiltro" name="catFiltro">
                    <option selected>            </option>
                    <option selected>Mais comprou</option>
                    <option selected>Menos comprou</option>
                </select>
                <label for="catFiltro">Categorias</label>
                <button onclick="" class="btn btn-primary">Filtrar</button>
            </div> -->

            <div class="d-flex">
                <div class="input-group">
                    <input type="text" class="form-control shadow-none" placeholder="Pesquisar" id="pesquisar"
                        name="pesquisar">
                    <button onclick="pesquisarDados()" class="btn btn-primary" type="button" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="mt-3 ps-1" style="height: 70vh; overflow: auto;">
            <table class="table table-hover">
                <!-- <caption class="caption-bottom">LEGENDA DA TABELA</caption> -->
                <thead class="table-dark">
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex flex-column">
                                    <i onclick="filtrarDados(1)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-up"></i>
                                    <i onclick="filtrarDados(2)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-down"></i>
                                </div>
                                Nome
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex flex-column">
                                    <i onclick="filtrarDados(3)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-up"></i>
                                    <i onclick="filtrarDados(4)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-down"></i>
                                </div>
                                E-mail
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex flex-column">
                                    <i onclick="filtrarDados(5)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-up"></i>
                                    <i onclick="filtrarDados(6)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-down"></i>
                                </div>
                                Contato
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex flex-column">
                                    <i onclick="filtrarDados(7)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-up"></i>
                                    <i onclick="filtrarDados(8)" id="filtro" name="filtro"
                                        class="order-hover bi bi-chevron-down"></i>
                                </div>
                                CPF
                            </div>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="table-group-divider table-hover-shadow">
                    <!-- TABELA MAPEADA -->
                    <?php foreach ($clientes as $indice => $cliente) { ?>
                        <?php if ($cliente->CLI_STATUS == 0) { ?>
                            <tr class="table-active">
                            <?php } else { ?>
                            <tr>
                            <?php } ?>
                            <th scope="row" class="">
                                <?= $cliente->CLI_NOME ?>
                            </th>
                            <td>
                                <?= $cliente->CLI_EMAIL ?>
                            </td>

                            <td>
                                <?= $cliente->CLI_CONTATO ?>
                            </td>

                            <td>
                                <?= $cliente->CLI_CPF ?>
                            </td>


                            <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                                <!-- BOTÃO EDITAR PRODUTO -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editarClienteModal<?= $indice ?>">
                                    <i class="bi bi-pencil-square text-info fs-5"></i>
                                </button>
                                <!------->
                        </td>
                    </tr>
                    <?php } ?>
                    <!------->
                </tbody>
            </table>
        </div>
    </div>

    <!-- CADASTRAR CLIENTE -->
    <div class="modal fade" id="cadastrarClienteModal" tabindex="-1" aria-labelledby="cadastrarClienteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarClienteModalLabel">Registrar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" method="post"
                        action="../../classes/Cliente/cliente.controller.php?acao=inserir">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="cliente" name="cliente"
                                            placeholder="Nome">
                                        <label for="cliente">Nome</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="email" name="email"
                                        placeholder="E-mail">
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="contato" name="contato"
                                        placeholder="Contato">
                                    <label for="contato">Contato</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="cpf" name="cpf" placeholder="CPF">
                                    <label for="cpf">CPF</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Registrar Cliente</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- EDITAR PRODUTO -->
    <?php foreach ($clientes as $indice => $cliente) { ?>
        <div class="modal fade" id="editarClienteModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="editarClienteModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarClienteModalLabel<?= $indice ?>">Editar Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container" method="post"
                            action="../../classes/Cliente/cliente.controller.php?acao=editar&id=<?= $cliente->CLI_ID ?>">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">#</span>
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="cliente" name="cliente"
                                                placeholder="Nome" value="<?= $cliente->CLI_NOME ?>">
                                            <label for="cliente">Nome</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail"
                                            value="<?= $cliente->CLI_EMAIL ?>">
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="contato" name="contato"
                                            placeholder="Contato" value="<?= $cliente->CLI_CONTATO ?>">
                                        <label for="contato">Contato</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="cpf" name="cpf" placeholder="CPF"
                                            value="<?= $cliente->CLI_CPF ?>">
                                        <label for="cpf">CPF</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-primary">Editar cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!----------------------->

    <!-- TOAST DE CONFIRMAR AÇÃO REALIZADA -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast bg-white" id="toast">
            <?php $toastAcao = isset($_GET['act']) ? $_GET['act'] : $toastAcao; ?>
            <?php if ($toastAcao === 'inserir') { ?>
                <div class="toast-header fs-5">
                    <i class="bi bi-square-fill text-success"></i>
                    <strong class="me-auto ms-3">Inserir</strong>
                    <button type="button" class="btn-close" onclick="closeToast()"></button>
                </div>
                <div class="toast-body fs-6">
                    <strong>Cliente registrado com sucesso!</strong>
                </div>
            <?php } else if ($toastAcao === 'editar') { ?>
                    <div class="toast-header fs-5">
                        <i class="bi bi-square-fill text-primary"></i>
                        <strong class="me-auto ms-3">Editar</strong>
                        <button type="button" class="btn-close" onclick="closeToast()"></button>
                    </div>
                    <div class="toast-body fs-6">
                        <strong>Cliente editado com sucesso!</strong>
                    </div>
            <?php } ?>
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