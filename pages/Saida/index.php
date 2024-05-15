<?php
$acao = 'recuperar';

require '../../classes/Saida/saida.controller.php';
require '../../classes/Cliente/cliente.controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate | Saída</title>

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
                <div class="col-8">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Colaboradores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="../estoque">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="../entrada">Entrada</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font selected" href="../saida">Saída</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Relatórios</a>
                        </li>
                    </ul>
                </div>
                <!------->

                <!-- SAIR -->
                <div class="col-2 text-end">
                    <button class="btn btn-lg text-secondary nav-font">Sair</button>
                </div>
                <!------->
            </div>
        </nav>
    </div>
    <!------->

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <!-- BOTÃO DE REGISTRAR SAÍDA DE PRODUTO -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#saidaProdutoModal">
                    Saída
                </button>
                <!------->

                <!-- BOTÃO DE REGISTRAR CLIENTE -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#registrarClienteModal">
                    Cliente
                </button>
                <!------->
            </div>

            <div class="box-search d-flex">
                <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar">
                <button onclick="pesquisarDados()" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="ps-1" style="height: 70vh; overflow: auto;">
            <table class="table table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Data Compra</th>
                        <th scope="col">Data Pagamento</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Forma Pagamento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="table-group-divider table-hover-shadow">
                    <?php foreach ($saidas as $indice => $saida) { ?>
                    <tr>
                        <td>
                            <?= $saida->CLI_NOME ?>
                        </td>
                        <td scope="row">
                            <?= date("d/m/Y", strtotime($saida->SAIDA_DATA_VENDA)) ?>
                        </td>
                        <td>
                            <?= date("d/m/Y", strtotime($saida->SAIDA_DATA_PAGAMENTO)) ?>
                        </td>
                        <td>
                            <?= number_format($saida->SAIDA_VALOR_TOTAL, 2, ',', '.') ?>
                        </td>
                        <td>
                            <?= $saida->SAIDA_FORMA_PAGAMENTO ?>
                        </td>

                        <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                            <!-- BOTÃO EDITAR ENTRADA -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editarSaidaModal<?= $indice ?>">
                                    <i class="bi bi-pencil-square text-info fs-5"></i>
                                </button>
                                <!------->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- SAÍDA PRODUTO -->
    <div class="modal fade" id="saidaProdutoModal" tabindex="-1" aria-labelledby="saidaProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saidaProdutoModalLabel">Saída de Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" method="post"
                        action="../../classes/Saida/saida.controller.php?acao=inserir">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="cliente" name="cliente">
                                        <option selected></option>
                                        <?php foreach ($clientes as $indice => $cliente) { ?>
                                            <option value="<?= $cliente->CLI_ID ?>"><?= $cliente->CLI_NOME ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="cliente">Cliente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">R$</span>
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="valorTotal" name="valorTotal"
                                            placeholder="Valor total">
                                        <label for="valorTotal">Valor total</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="formaPagamento" name="formaPagamento">
                                        <option selected></option>
                                        <option value="Cartão de crédito">Cartão de Crédito</option>
                                        <option value="Cartão de Débito">Cartão de Débito</option>
                                        <option value="Transferência Bancária">Transferência Bancária</option>
                                        <option value="Dinheiro">Dinheiro</option>
                                        <option value="Boleto">Boleto</option>
                                    </select>
                                    <label for="formaPagamento">Forma de pagamento</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="date" id="dataVenda" name="dataVenda"
                                        placeholder="Data de venda">
                                    <label for="dataVenda">Data de venda</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="date" id="dataPagamento" name="dataPagamento"
                                        placeholder="Data de pagamento">
                                    <label for="dataPagamento">Data de pagamento</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Registrar Saída</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- EDITAR SAÍDA -->
    <?php foreach ($saidas as $indice => $saida) { ?>
        <div class="modal fade" id="editarSaidaModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="editarSaidaModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarSaidaModalLabel<?= $indice ?>">Editar Saída</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container" method="post"
                            action="../../classes/Saida/saida.controller.php?acao=editar&id=<?= $saida->SAIDA_ID ?>">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <select class="form-select" id="cliente" name="cliente">
                                            <?php foreach ($clientes as $cliente_item) { ?>
                                                <?php if ($cliente_item->CLI_ID == $saida->CLIENTE_CLI_ID) { ?>
                                                    <option value="<?= $cliente_item->CLI_ID ?>" selected>
                                                        <?= $cliente_item->CLI_NOME ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?= $cliente_item->CLI_ID ?>">
                                                        <?= $cliente_item->CLI_NOME ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <label for="cliente">Cliente</label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="button" class="btn btn-primary rounded-circle"
                                        data-bs-toggle="modal" data-bs-target="#cadastrarProdutoModal">
                                        <i class="bi bi-plus-lg fs-5"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">R$</span>
                                        <div class="form-floating">
                                            <input class="form-control" value="<?= $saida->SAIDA_VALOR_TOTAL ?>"
                                                type="number" id="valorTotal" name="valorTotal" placeholder="Valor total">
                                            <label for="valorTotal">Valor total</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="formaPagamento" name="formaPagamento">
                                            <option selected value="<?= $saida->SAIDA_FORMA_PAGAMENTO ?>">
                                                <?= $saida->SAIDA_FORMA_PAGAMENTO ?>
                                            </option>
                                            <option value="Cartão de crédito">Cartão de Crédito</option>
                                            <option value="Cartão de Débito">Cartão de Débito</option>
                                            <option value="Transferência Bancária">Transferência Bancária</option>
                                            <option value="Dinheiro">Dinheiro</option>
                                            <option value="Boleto">Boleto</option>
                                        </select>
                                        <label for="formaPagamento">Forma de pagamento</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" value="<?= $saida->SAIDA_DATA_VENDA ?>" type="date"
                                            id="dataVenda" name="dataVenda" placeholder="Data de venda">
                                        <label for="dataVenda">Data de venda</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" value="<?= $saida->SAIDA_DATA_PAGAMENTO ?>" type="date"
                                            id="dataPagamento" name="dataPagamento" placeholder="Data de pagamento">
                                        <label for="dataPagamento">Data de pagamento</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-primary">Editar Saída</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!----------------------->

     <!-- REGISTRAR FORNECEDOR -->
     <div class="modal fade" id="registrarClienteModal" tabindex="-1" aria-labelledby="registrarClienteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registrarClienteModalLabel">Registrar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" method="post"
                        action="../../classes/Cliente/cliente.controller.php?acao=inserir">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="cliente" name="cliente"
                                        placeholder="Nome">
                                    <label for="cliente">Nome</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
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
                    <strong>Saída registrada com sucesso!</strong>
                </div>
            <?php } else if ($toastAcao === 'editar') { ?>
                    <div class="toast-header fs-5">
                        <i class="bi bi-square-fill text-primary"></i>
                        <strong class="me-auto ms-3">Editar</strong>
                        <button type="button" class="btn-close" onclick="closeToast()"></button>
                    </div>
                    <div class="toast-body fs-6">
                        <strong>Saída editada com sucesso!</strong>
                    </div>
            <?php } ?>
        </div>
    </div>

    <!----------------------->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="../../js/script.js"></script>
</body>

</html>