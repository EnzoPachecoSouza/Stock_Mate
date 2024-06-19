<?php
date_default_timezone_set('America/Sao_Paulo');

include '../Login/session_check.php';

$acao = 'recuperar';

require '../../classes/Entrada/entrada.controller.php';
require '../../classes/Entrada/ItensEntrada/itensEntrada.controller.php';
require '../../classes/Fornecedor/fornecedor.controller.php';
require '../../classes/Produto/produto.controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate | Entrada</title>

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
                            <a class="nav-link text-white nav-font" href="../estoque">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font selected" href="../entrada">Entrada</a>
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
                                <a class="nav-link text-white nav-font" href="../relatorio">Relatórios</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!------->

                <!-- SAIR -->
                <div class="col-1 text-end">
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
    </div>
    <!------->

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <!-- BOTÃO DE REGISTRAR ENTRADA DE PRODUTO -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#entradaProdutoModal">
                    Entrada
                </button>
                <!------->

                <!-- BOTÃO DE REGISTRAR FORNECEDOR -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#registrarFornecedorModal">
                    Fornecedor
                </button>
                <!------->
            </div>

            <div class="d-flex gap-5">
                <div class="form-floating d-flex">
                    <button onclick="filtrarDados(9)" class="btn btn-primary" type="button" id="button-addon2">Limpar
                        filtros</button>
                </div>

                <div class="form-floating d-flex">
                    <div class="input-group">
                        <select class="form-select shadow-none" id="catPag" name="catPag">
                            <option disabled selected>Forma de Pagamento</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cartão de Débito">Cartão de Débito</option>
                            <option value="Transferência Bancária">Transferência Bancária</option>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Boleto">Boleto</option>
                        </select>
                        <button onclick="filtrarFormaPagamento()" class="btn btn-primary" type="button"
                            id="button-addon2">Filtrar</button>
                    </div>
                </div>

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
        </div>

        <div class="ps-1 mt-3" style="height: 70vh; overflow: auto;">
            <table class="table table-hover">
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
                                Fornecedor
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
                                Data Compra
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
                                Data Pagamento
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
                                Valor Total
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    Forma de Pagamento
                                    <div class="d-flex flex-column invisible">
                                        <i class="order-hover bi bi-chevron-up"></i>
                                        <i class="order-hover bi bi-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="table-group-divider table-hover-shadow">
                    <?php foreach ($entradas as $indice => $entrada) { ?>
                    <tr>
                        <td>
                            <?= $entrada->FOR_NOME ?>
                        </td>
                        <td scope="row">
                            <?= date("d/m/Y", strtotime($entrada->ENT_DATA_COMPRA)) ?>
                        </td>
                        <td>
                            <?= date("d/m/Y", strtotime($entrada->ENT_DATA_PAGAMENTO)) ?>
                        </td>
                        <td>
                            R$
                            <?= number_format($entrada->ENT_VALOR_TOTAL, 2, ',', '.') ?>
                        </td>
                        <td>
                            <?= $entrada->ENT_FORMA_PAGAMENTO ?>
                        </td>

                        <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                            <!-- VISUALIZAR DETALHES -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#visualizarDetalhesEntradaModal<?= $indice ?>">
                                    <i class="bi bi-eye-fill text-success fs-5"></i>
                                </button>
                                <!------->

                            <!-- BOTÃO EDITAR ENTRADA -->
                                <?php
                                $data_registro = new DateTime($entrada->ENT_HORA_DE_REGISTRO);
                                $data_bloquear_atualizacao = $data_registro->modify('+1 day');
                                $data_atual = new DateTime();
                                ?>

                                <?php if ($data_atual > $data_bloquear_atualizacao) { ?>
                                    <button type="button" class="btn">
                                        <i class="bi bi-pencil-square text-danger fs-5"></i>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#editarEntradaModal<?= $indice ?>">
                                        <i class="bi bi-pencil-square text-info fs-5"></i>
                                    </button>
                                <?php } ?>
                                <!------->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ENTRADA PRODUTO -->
    <div class="modal fade" id="entradaProdutoModal" tabindex="-1" aria-labelledby="entradaProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="entradaProdutoModalLabel">Entrada de Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container needs-validation" novalidate method="post"
                        action="../../classes/Entrada/entrada.controller.php?acao=inserir"
                        onsubmit="prepareSelectedProducts()">

                        <input type="hidden" id="selectedProducts" name="selectedProducts">

                        <div class="row align-items-center mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="fornecedor" name="fornecedor" required>
                                        <option selected></option>
                                        <?php foreach ($fornecedores as $indice => $fornecedor) { ?>
                                            <option value="<?= $fornecedor->FOR_ID ?>"><?= $fornecedor->FOR_NOME ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="fornecedor">Fornecedor</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">R$</span>
                                    <div class="form-floating">
                                        <input class="form-control form-disabled" type="text" id="valorTotal"
                                            name="valorTotal" placeholder="Valor total" readonly>
                                        <label for="valorTotal">Valor total</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="formaPagamento" name="formaPagamento" required>
                                        <option selected value=""></option>
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

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="date" id="dataCompra" name="dataCompra"
                                        placeholder="Data de compra" required>
                                    <label for="dataCompra">Data de compra</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="date" id="dataPagamento" name="dataPagamento"
                                        placeholder="Data de pagamento" required>
                                    <label for="dataPagamento">Data de pagamento</label>
                                </div>
                            </div>
                        </div>

                        <div id="products" class="mt-3">
                            <div class="row mb-2 product-item">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select produto" name="produto[]"
                                            oninput="determinaValorUnitario(this)" required>
                                            <option value="" selected></option>
                                            <?php foreach ($produtos as $produto) { ?>
                                                <option value="<?= $produto->PRO_PRECO_VENDA ?>-<?= $produto->PRO_ID ?>">
                                                    <?= $produto->PRO_NOME ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label>Produto</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control quantidade" type="number" name="quantidade[]"
                                            placeholder="Quantidade" min="1" oninput="atualizaValorTotal()" required>
                                        <label>Quantidade</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control valorUnitario" type="number" name="valorUnitario[]"
                                            placeholder="Valor unitário" readonly>
                                        <label>Valor Unitário</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary bg-primary"
                                    onclick="createNewProductForm()">
                                    Adicionar produto
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Registrar Entrada</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedProducts = [];

        function determinaValorUnitario(selectElement) {
            const [valorUnitario, id] = selectElement.value.split('-');
            const valorUnitarioInput = selectElement.closest('.product-item').querySelector('.valorUnitario');
            valorUnitarioInput.value = valorUnitario;
            atualizaValorTotal();

            selectElement.setAttribute('data-id', id);
            atualizaIdsEQuantidades();
        }

        function atualizaIdsEQuantidades() {
            const productItems = document.querySelectorAll('.product-item');
            selectedProducts = Array.from(productItems).map(item => {
                const selectElement = item.querySelector('.produto');
                const id = selectElement.getAttribute('data-id');
                const quantidade = item.querySelector('.quantidade').value || 0;
                return { id, quantidade };
            }).filter(item => item.id);

            console.log(`Produtos Selecionados:`, selectedProducts);
            document.querySelector('#selectedProducts').value = JSON.stringify(selectedProducts);
        }

        function atualizaValorTotal() {
            const productItems = document.querySelectorAll('.product-item');
            let valorTotal = 0;

            productItems.forEach(item => {
                const quantidade = item.querySelector('.quantidade').value || 0;
                const valorUnitario = item.querySelector('.valorUnitario').value || 0;
                valorTotal += quantidade * valorUnitario;
            });

            atualizaIdsEQuantidades();

            document.querySelector('#valorTotal').value = valorTotal.toFixed(2);
        }

        function createNewProductForm() {
            const products = document.querySelector('#products');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'product-item');

            row.innerHTML = `
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select produto" name="produto[]" oninput="determinaValorUnitario(this)" required>
                    <option value="" selected></option>
                    <?php foreach ($produtos as $produto) { ?>
                                                                            <option value="<?= $produto->PRO_PRECO_VENDA ?>-<?= $produto->PRO_ID ?>"><?= $produto->PRO_NOME ?></option>
                    <?php } ?>
                </select>
                <label>Produto</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control quantidade" type="number" name="quantidade[]" placeholder="Quantidade" oninput="atualizaValorTotal(); atualizaIdsEQuantidades();" required>
                <label>Quantidade</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control valorUnitario" type="number" name="valorUnitario[]" placeholder="Valor unitário" readonly>
                <label>Valor Unitário</label>
            </div>
        </div>
    `;

            products.appendChild(row);
        }

        function prepareSelectedProducts() {
            const selectedProductsField = document.querySelector('#selectedProducts');
            selectedProductsField.value = JSON.stringify(selectedProducts);
        }
    </script>
    <!-------------------->

    <!-- EDITAR ENTRADA -->
    <?php foreach ($entradas as $indice => $entrada) { ?>
        <div class="modal fade" id="editarEntradaModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="editarEntradaModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarEntradaModalLabel<?= $indice ?>">Editar Entrada</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container needs-validation" novalidate method="post"
                            action="../../classes/Entrada/entrada.controller.php?acao=editar&id=<?= $entrada->ENT_ID ?>">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="fornecedor" name="fornecedor" required>
                                            <?php foreach ($fornecedores as $fornecedor) { ?>
                                                <?php if ($fornecedor->FOR_ID == $entrada->FORNECEDORES_FOR_ID) { ?>
                                                    <option value="<?= $fornecedor->FOR_ID ?>" selected>
                                                        <?= $fornecedor->FOR_NOME ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?= $fornecedor->FOR_ID ?>">
                                                        <?= $fornecedor->FOR_NOME ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <label for="fornecedor">Fornecedor</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">R$</span>
                                        <div class="form-floating">
                                            <input class="form-control" value="<?= $entrada->ENT_VALOR_TOTAL ?>"
                                                type="number" id="valorTotal" name="valorTotal" placeholder="Valor total"
                                                readonly>
                                            <label for="valorTotal">Valor total</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="formaPagamento" name="formaPagamento" required>
                                            <option selected value="<?= $entrada->ENT_FORMA_PAGAMENTO ?>">
                                                <?= $entrada->ENT_FORMA_PAGAMENTO ?>
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
                                        <input class="form-control" value="<?= $entrada->ENT_DATA_COMPRA ?>" type="date"
                                            id="dataCompra" name="dataCompra" placeholder="Data de compra" required>
                                        <label for="dataCompra">Data de compra</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" value="<?= $entrada->ENT_DATA_PAGAMENTO ?>" type="date"
                                            id="dataPagamento" name="dataPagamento" placeholder="Data de pagamento"
                                            required>
                                        <label for="dataPagamento">Data de pagamento</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-primary">Editar Entrada</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!----------------------->

    <!-- VER MAIS DETALHES -->
    <?php foreach ($entradas as $indice => $entrada) { ?>
        <!-- VER MAIS DETALHES -->
        <div class="modal fade" id="visualizarDetalhesEntradaModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="visualizarDetalhesEntradaModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="visualizarDetalhesEntradaModalLabel<?= $indice ?>">Detalhes da
                            Entrada</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <?php foreach ($itensEntradaRecuperar as $indice => $itensEntrada) { ?>
                                <?php if ($itensEntrada->ENTRADA_ENT_ID === $entrada->ENT_ID) { ?>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text fw-bold">#</span>
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" id="codigo" name="codigo"
                                                        placeholder="Código" value="<?= $produto->PRO_CODIGO ?>" disabled>
                                                    <label for="codigo">Código</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"
                                                    value="<?= $produto->PRO_NOME ?>" disabled>
                                                <label for="nome">Nome</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- REGISTRAR FORNECEDOR -->
    <div class="modal fade" id="registrarFornecedorModal" tabindex="-1" aria-labelledby="registrarFornecedorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registrarFornecedorModalLabel">Registrar Fornecedor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container needs-validation" novalidate method="post"
                        action="../../classes/Fornecedor/fornecedor.controller.php?acao=inserir-from-entrada">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="fornecedor" name="fornecedor"
                                        placeholder="Nome" required>
                                    <label for="fornecedor">Nome</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email"
                                        required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="contato" name="contato"
                                        placeholder="Contato" required>
                                    <label for="contato">Contato</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="cnpj" name="cnpj" placeholder="CNPJ"
                                        required>
                                    <label for="cnpj">CNPJ</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Registrar Fornecedor</button>
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
                    <strong>Entrada registrada com sucesso!</strong>
                </div>
            <?php } else if ($toastAcao === 'editar') { ?>
                    <div class="toast-header fs-5">
                        <i class="bi bi-square-fill text-primary"></i>
                        <strong class="me-auto ms-3">Editar</strong>
                        <button type="button" class="btn-close" onclick="closeToast()"></button>
                    </div>
                    <div class="toast-body fs-6">
                        <strong>Entrada editada com sucesso!</strong>
                    </div>
            <?php } else if ($toastAcao == 'inserir-fornecedor') { ?>
                        <div class="toast-header fs-5">
                            <i class="bi bi-square-fill text-success"></i>
                            <strong class="me-auto ms-3">Inserir</strong>
                            <button type="button" class="btn-close" onclick="closeToast()"></button>
                        </div>
                        <div class="toast-body fs-6">
                            <strong>Fornecedor registrado com sucesso!</strong>
                        </div>
            <?php } else if ($toastAcao === 'alterarSenha') { ?>
                            <div class="toast-header fs-5">
                                <i class="bi bi-square-fill text-info"></i>
                                <strong class="me-auto ms-3">Alterar Senha</strong>
                                <button type="button" class="btn-close" onclick="closeToast()"></button>
                            </div>
                            <div class="toast-body fs-6">
                                <strong>Senha alterada com sucesso!</strong>
                            </div>
            <?php } ?>
        </div>
    </div>
    <!----------------------->

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
                        action="../../classes/Colaborador/colaborador.controller.php?acao=alterarSenha&id=<?= $_SESSION['id'] ?>">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="senhaAtual" name="senhaAtual"
                                        placeholder="Senha Atual" oninput="verificaSenha(this.value)">
                                    <label for="senhaAtual">Senha Atual</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="novaSenha" name="novaSenha"
                                        placeholder="Senha Nova" disabled>
                                    <label for="novaSenha">Senha Nova</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="confirmarSenhaNova"
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

    <script>
        function verificaSenha(senha) {
            const senhaAtual = "<?= $_SESSION['senha'] ?>"
            const senhaNovaInput = document.querySelector('#novaSenha')
            const senhaNovaConfirmaInput = document.querySelector('#confirmarSenhaNova')

            if (senha === senhaAtual) {
                senhaNovaInput.removeAttribute('disabled')
                senhaNovaConfirmaInput.removeAttribute('disabled')
            }
        }
    </script>

    <script>
        (function () {
            'use strict'

            let forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                });
        })()
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="../../js/script.js"></script>
</body>

</html>