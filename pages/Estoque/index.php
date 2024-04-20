<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../../styles/custom.css">

    <!-- Style -->
    <link rel="stylesheet" href="./styles.css">
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
                            <a class="nav-link text-white" href="#">Estoque</a>
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

    <div class="container d-flex flex-column justify-content-center mt-5">
        <div class="d-flex justify-content-center align-items-center gap-3" style="position: relative">
            <button class="btn btn-lg btn-primary">Entrada</button>
            <button class="btn btn-lg btn-primary">Saída</button>

            <!-- BOTÃO DE CRIAR PRODUTO -->
            <button type="button" class="btn btn-primary rounded-circle" style="position: absolute; top: 0; right: 0"
                data-bs-toggle="modal" data-bs-target="#cadastrarProdutoModal">
                <i class="bi bi-plus-lg"></i>
            </button>
            <!------->
        </div>

        <table class="table table-hover table-bordered">
            <caption class="caption-top">LEGENDA DA TABELA</caption>
            <thead class="table-active">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">PRODUTO</th>
                    <th scope="col">TIPO</th>
                    <th scope="col">QUANTIDADE</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                <!-- DADOS ESTÁTICOS PARA MAPEAMENTO DA TABELA DE PRODUTOS EM ESTOQUE -->
                <?php
                $produtos = [
                    ["id" => 1, "nome" => "Coca-Cola", "tipo" => "Refrigerante", "quantidade" => 12, "minimo" => 10, "maximo" => 30],
                    ["id" => 2, "nome" => "Trakinas", "tipo" => "Bolacha", "quantidade" => 8, "minimo" => 10, "maximo" => 30],
                    ["id" => 3, "nome" => "Tang", "tipo" => "Suco", "quantidade" => 25, "minimo" => 10, "maximo" => 30],
                ]
                    ?>
                <!------->

                <!-- TABELA MAPEADA -->
                <?php foreach ($produtos as $produto) { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $produto["id"]; ?>
                        </th>
                        <td>
                            <?php echo $produto["nome"]; ?>
                        </td>
                        <td>
                            <?php echo $produto["tipo"]; ?>
                        </td>

                        <!-- COR DE FUNDO DA COLUNA "QUANTIDADE" (VOU TRANSFORMAR ISSO EM UMA FUNÇÃO PARA LIMPAR O CÓDIGO) -->
                        <td> <!-- COLOCAR CODIGO DO NOTES AQUI -->
                            <h4 class="text-center"><?php echo $produto["quantidade"]; ?></h4>
                        </td>
                        <!------->

                    <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                        <!-- BOTÃO VISUALIZAR DETALHES -->
                            <i class="bi bi-eye-fill"></i>
                            <!------->

                        <!-- BOTÃO EDITAR PRODUTO -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarProdutoModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <!------->

                        <!-- BOTÃO DESATIVAR PRODUTO -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#desativarProdutoModal">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                            <!------->
                    </td>
                </tr>
                <?php } ?>
                <!------->
            </tbody>

        </table>
    </div>

    <!-- CADASTRAR PRODUTO -->
    <div class="modal fade" id="cadastrarProdutoModal" tabindex="-1" aria-labelledby="cadastrarProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarProdutoModalLabel">Registrar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="produto">Produto</label>
                                <input class="form-control" type="text" id="produto" name="produto">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo"></select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="estoque-minimo">Estoque mínimo</label>
                                <input class="form-control" type="number" id="estoque-minimo" name="estoque-minimo">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="estoque-maximo">Estoque máximo</label>
                                <input class="form-control" type="number" id="estoque-maximo" name="estoque-maximo">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Registar produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- EDITAR PRODUTO -->
    <div class="modal fade" id="editarProdutoModal" tabindex="-1" aria-labelledby="editarProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarProdutoModalLabel">Editar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="produto">Produto</label>
                                <input class="form-control" type="text" id="produto" name="produto">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo"></select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="estoque-minimo">Estoque mínimo</label>
                                <input class="form-control" type="number" id="estoque-minimo" name="estoque-minimo">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="estoque-maximo">Estoque máximo</label>
                                <input class="form-control" type="number" id="estoque-maximo" name="estoque-maximo">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary">Editar produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- DESATIVAR PRODUTO -->
    <div class="modal fade" id="desativarProdutoModal" tabindex="-1" aria-labelledby="desativarProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="desativarProdutoModalLabel">Desativar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container" action="">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4>Deseja desativar esse produto?</h4>
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <button class="btn btn-outline-success">Sim</button>
                            <button class="btn btn-outline-danger">Não</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----------------------->

    <!-- ENTRADA PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
            <form class="container" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="fornecedor">Fornecedor</label>
                        <input class="form-control" type="text" id="fornecedor" name="fornecedor">
                    </div>

                    <div class="col-md-4"></div>

                    <div class="col-md-4">
                        <label class="form-label" for="data-entrada">Data da entrada</label>
                        <input class="form-control" type="date" id="data-entrada" name="data-entrada">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="valor-total">Valor total</label>
                        <input class="form-control" type="number" id="valor-total" name="valor-total">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="forma-pagamento">Forma de pagamento</label>
                        <select class="form-control" id="forma-pagamento" name="forma-pagamento"></select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="data-pagamento">Data do pagamento</label>
                        <input class="form-control" type="date" id="data-pagamento" name="data-pagamento">
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <i class="bi bi-plus-circle-fill"></i>
                </div> -->

    <!------------>
    <!-- TABELA -->
    <!------------>

    <!-- <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-primary">Registrar Entrada</button>
                </div>
            </form>
        </div>
    </div> -->
    <!----------------------->

    <!-- SAÍDA PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
            <form class="container" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="ciente">Cliente</label>
                        <input class="form-control" type="text" id="ciente" name="ciente">
                    </div>

                    <div class="col-md-4"></div>

                    <div class="col-md-4">
                        <label class="form-label" for="data-saida">Data da saída</label>
                        <input class="form-control" type="date" id="data-saida" name="data-saida">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="valor-total">Valor total</label>
                        <input class="form-control" type="number" id="valor-total" name="valor-total">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="forma-pagamento">Forma de pagamento</label>
                        <select class="form-control" id="forma-pagamento" name="forma-pagamento"></select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="data-pagamento">Data do pagamento</label>
                        <input class="form-control" type="date" id="data-pagamento" name="data-pagamento">
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <i class="bi bi-plus-circle-fill"></i>
                </div> -->

    <!------------>
    <!-- TABELA -->
    <!------------>

    <!-- <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-primary">Registrar Saída</button>
                </div>
            </form>
        </div>
    </div>
        <div class="modal-box">
            <form class="container" action="">

            </form>
        </div>
    </div> -->
    <!----------------------->

    <!-- VER MAIS DETALHES -->
    <!-- <div class="modal">
        <div class="modal-box">
            <table>
                <tr>
                    <th>Entrada</th>
                    <th>Quantidade</th>
                    <th>Fornecedor</th>
                    <th>Saída</th>
                    <th>Quantidade</th>
                    <th>Cliente</th>
                </tr> -->

    <!-- <tr>
        <th>DATA DA ENTRADA</th>
        <th>QUANTIDADE (ENTRADA)</th>
        <th>NOME DO FORNECEDOR</th>
        <th>DATA DA SAÍDA</th>
        <th>QUANTIDADE (SAIDA)</th>
        <th>NOME DO CLIENTE</th>
    </tr> -->

    <!-- </table>
        </div>
    </div> -->
    <!----------------------->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>