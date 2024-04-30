<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate | Entrada</title>

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
    <div class="container-fluid bg-primary">
        <div class="container">
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
                            <a class="nav-link text-white" href="#">Colaboradores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="../estoque">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="">Entrada</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Relatórios</a>
                        </li>
                    </ul>
                </div>
                <!------->

                <!-- SAIR -->
                <div class="col-3 text-end">
                    <button class="btn btn-lg text-secondary">Sair</button>
                </div>
                <!------->
            </div>
        </div>
    </div>
    <!------->

    <div class="container mt-5">
        <table class="table table-hover table-bordered mt-3">
            <!-- <caption class="caption-bottom">LEGENDA DA TABELA</caption> -->
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

            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">
                        data de compra
                    </th>
                    <td>
                        valor total
                    </td>
                    <td>
                        data pagamento
                    </td>
                    <td>
                        fornecedor
                    </td>
                    <td>
                        forma pagamento
                    </td>

                    <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                        <!-- BOTÃO VISUALIZAR DETALHES -->
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#visualizarDetalhesProdutoModal">
                            <i class="bi bi-eye-fill text-success fs-5"></i>
                        </button>
                        <!------->

                        <!-- BOTÃO EDITAR PRODUTO -->
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#editarProdutoModal<?= $indice ?>">
                            <i class="bi bi-pencil-square text-info fs-5"></i>
                        </button>
                        <!------->

                        <!-- BOTÃO DESATIVAR PRODUTO -->
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#desativarProdutoModal<?= $indice ?>">
                            <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                        </button>
                        <!------->
                    </td>
                </tr>
            </tbody>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="../../js/script.js"></script>
</body>

</html>