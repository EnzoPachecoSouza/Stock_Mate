<?php
$acao = 'recuperar';

require '../../classes/Entrada/entrada.controller.php';
require '../../classes/Fornecedor/fornecedor.controller.php';
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
                <div class="col-3">
                    <img src="" alt="[Logo] Stock Mate">
                </div>
                <!------->

                <!-- NAVIGATION -->
                <div class="col-6">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Colaboradores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="../estoque">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font selected" href="">Entrada</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="#">Relatórios</a>
                        </li>
                    </ul>
                </div>
                <!------->

                <!-- SAIR -->
                <div class="col-3 text-end">
                    <button class="btn btn-lg text-secondary nav-font">Sair</button>
                </div>
                <!------->
            </div>
        </nav>
    </div>
    <!------->

    <div class="container mt-5">
        <div class="d-flex justify-content-start align-items-center">
            <div>
                <!-- BOTÃO DE REGISTRAR ENTRADA DE PRODUTO -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#entradaProdutoModal">
                    Entrada
                </button>
                <!------->
            </div>
        </div>

        <div class="ps-1" style="height: 70vh; overflow: auto;">
            <table class="table table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Data Compra</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Data Pagamento</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Forma Pagamento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="table-group-divider table-hover-shadow">
                    <?php foreach ($entradas as $indice => $entrada) { ?>
                    <tr>
                        <td scope="row">
                            <?= date("d/m/Y", strtotime($entrada->ENT_DATA_COMPRA)) ?>
                        </td>
                        <td>
                            <?= number_format($entrada->ENT_VALOR_TOTAL, 2, ',', '.') ?>
                        </td>
                        <td>
                            <?= date("d/m/Y", strtotime($entrada->ENT_DATA_PAGAMENTO)) ?>
                        </td>
                        <td>
                            fornecedor
                        </td>
                        <td>
                            <?= $entrada->ENT_FORMA_PAGAMENTO ?>
                        </td>

                        <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                            <!-- BOTÃO EDITAR ENTRADA -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editarEntradaModal<?= $indice ?>">
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
                    <form class="container" method="post"
                        action="../../classes/Entrada/entrada.controller.php?acao=inserir">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-10">
                                <div class="form-floating">
                                    <select class="form-select" id="fornecedor" name="fornecedor">
                                        <option selected></option>
                                        <?php foreach ($fornecedores as $indice => $fornecedor) { ?>
                                            <option value="<?= $fornecedor->FOR_ID ?>"><?= $fornecedor->FOR_NOME ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="fornecedor">Fornecedor</label>
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
                                    <input class="form-control" type="date" id="dataCompra" name="dataCompra"
                                        placeholder="Data de compra">
                                    <label for="dataCompra">Data de compra</label>
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
                            <button class="btn btn-outline-primary">Registrar Entrada</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

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
                        <form class="container" method="post"
                            action="../../classes/Entrada/entrada.controller.php?acao=editar&id=<?= $entrada->ENT_ID ?>">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <select class="form-select" id="fornecedor" name="fornecedor">
                                            <option selected></option>
                                            <?php foreach ($fornecedores as $indice => $fornecedor) { ?>
                                                <option value="<?= $fornecedor->FOR_ID ?>"><?= $fornecedor->FOR_NOME ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="fornecedor">Fornecedor</label>
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
                                            <input class="form-control" value="<?= $entrada->ENT_VALOR_TOTAL ?>"
                                                type="number" id="valorTotal" name="valorTotal" placeholder="Valor total">
                                            <label for="valorTotal">Valor total</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="formaPagamento" name="formaPagamento">
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
                                            id="dataCompra" name="dataCompra" placeholder="Data de compra">
                                        <label for="dataCompra">Data de compra</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" value="<?= $entrada->ENT_DATA_PAGAMENTO ?>" type="date"
                                            id="dataPagamento" name="dataPagamento" placeholder="Data de pagamento">
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