<?php
$acao = 'recuperar';

require '../../classes/Produto/produto.controller.php';
require '../../classes/Categoria/categoria.controller.php';
?>

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
                            <a class="nav-link text-white nav-font selected" href="">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="../entrada">Entrada</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white nav-font" href="../saida">Saída</a>
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
            <!-- BOTÃO DE CRIAR PRODUTO -->
            <div>
                <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal"
                    data-bs-target="#cadastrarProdutoModal">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
            <!------->

            <div class="box-search d-flex">
                <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar">
                <button onclick="pesquisarDados()" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>

        </div>


        <div class="mt-3 ps-1" style="height: 70vh; overflow: auto;">
            <table class="table table-hover">
                <!-- <caption class="caption-bottom">LEGENDA DA TABELA</caption> -->
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Material</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="table-group-divider table-hover-shadow">
                    <!-- TABELA MAPEADA -->
                    <?php foreach ($produtos as $indice => $produto) { ?>
                        <?php if ($produto->PRO_STATUS == 0) { ?>
                            <tr class="table-active">
                            <?php } else { ?>
                            <tr>
                            <?php } ?>
                            <th scope="row" class="">
                                <?= $produto->PRO_NOME ?>
                            </th>
                            <td>
                                <?= $produto->PRO_COR ?>
                            </td>
                            <td>
                                <?= $produto->PRO_DETALHES ?>
                            </td>
                            <td>
                                <?= $produto->PRO_MATERIAL ?>
                            </td>

                            <!-- COR DE FUNDO DA COLUNA "QUANTIDADE" (VOU TRANSFORMAR ISSO EM UMA FUNÇÃO PARA LIMPAR O CÓDIGO) -->
                            <?php if ($produto->PRO_QUANTIDADE <= $produto->PRO_MINIMO) { ?>
                                <td class="bg-danger">
                                <?php } else if ($produto->PRO_QUANTIDADE <= ($produto->PRO_MINIMO * 2)) { ?>
                                    <td class="bg-secondary">
                                <?php } else { ?>
                                    <td class="bg-success">
                                <?php } ?>
                                <?= $produto->PRO_QUANTIDADE ?>
                            </td>
                            <!------->

                        <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                            <!-- BOTÃO VISUALIZAR DETALHES -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#visualizarDetalhesProdutoModal<?= $indice ?>">
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
                                <?php if ($produto->PRO_STATUS === 1) { ?>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#desativarProdutoModal<?= $indice ?>">
                                        <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                    </button>
                                <?php } else { ?>
                                    <form method="post"
                                        action="../../classes/Produto/produto.controller.php?acao=ativar&id=<?= $produto->PRO_ID ?>">
                                        <button type="submit" class="btn">
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                        </button>
                                    </form>
                                <?php } ?>
                                <!------->
                        </td>
                    </tr>
                    <?php } ?>
                    <!------->
                </tbody>
            </table>
        </div>
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
                    <form class="container" method="post"
                        action="../../classes/Produto/produto.controller.php?acao=inserir">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">#</span>
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="codigo" name="codigo"
                                            placeholder="Código">
                                        <label for="codigo">Código</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome">
                                    <label for="nome">Nome</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="cor" name="cor" placeholder="Cor">
                                    <label for="cor">Cor</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="material" name="material"
                                        placeholder="Material">
                                    <label for="material">Material</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="categoria" name="categoria">
                                        <option selected></option>
                                        <?php foreach ($categorias as $indice => $categoria) { ?>
                                            <option value="<?= $categoria->CAT_ID ?>"><?= $categoria->CAT_CATEGORIA ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label for="categoria">Categoria</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="detalhes" name="detalhes"
                                        placeholder="Detalhes">
                                    <label for="detalhes">Detalhes</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">R$</span>
                                    <div class="form-floating">
                                        <input class="form-control" type="number" id="precoDeCompra"
                                            name="precoDeCompra" placeholder="Preço">
                                        <label for="precoDeCompra">Preço</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="quantidadeEmEstoque"
                                        name="quantidadeEmEstoque" placeholder="Quantidade">
                                    <label for="quantidadeEmEstoque">Quantidade</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="estoqueMinimo" name="estoqueMinimo"
                                        placeholder="Mínimo">
                                    <label for="estoqueMinimo">Mínimo</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Insira a descrição do produto"
                                        id="descricao" name="descricao" style="height: 100px"></textarea>
                                    <label for="descricao">Descrição</label>
                                </div>
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
    <?php foreach ($produtos as $indice => $produto) { ?>
        <div class="modal fade" id="editarProdutoModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="editarProdutoModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarProdutoModalLabel<?= $indice ?>">Editar Produto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container" method="post"
                            action="../../classes/Produto/produto.controller.php?acao=editar&id=<?= $produto->PRO_ID ?>">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">#</span>
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="codigo" name="codigo"
                                                placeholder="Código" value="<?= $produto->PRO_CODIGO ?>">
                                            <label for="codigo">Código</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"
                                            value="<?= $produto->PRO_NOME ?>">
                                        <label for="nome">Nome</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="cor" name="cor" placeholder="Cor"
                                            value="<?= $produto->PRO_COR ?>">
                                        <label for="cor">Cor</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="material" name="material"
                                            placeholder="Material" value="<?= $produto->PRO_MATERIAL ?>">
                                        <label for="material">Material</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="categoria" name="categoria">
                                            <option selected value="<?= $produto->PRO_CAT ?>">
                                                <?= $produto->PRO_CAT ?>
                                            </option>
                                            <?php foreach ($categorias as $indice => $categoria) { ?>
                                                <option value="<?= $categoria->CAT_ID ?>"><?= $categoria->CAT_CATEGORIA ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label for="categoria">Categoria</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="detalhes" name="detalhes"
                                            placeholder="Detalhes" value="<?= $produto->PRO_DETALHES ?>">
                                        <label for="detalhes">Detalhes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">R$</span>
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="precoDeCompra" name="precoDeCompra"
                                                placeholder="Preço" value="<?= $produto->PRO_PRECO_CUSTO ?>">
                                            <label for="precoDeCompra">Preço</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="quantidadeEmEstoque"
                                            name="quantidadeEmEstoque" placeholder="Quantidade"
                                            value="<?= $produto->PRO_QUANTIDADE ?>">
                                        <label for="quantidadeEmEstoque">Quantidade</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="estoqueMinimo" name="estoqueMinimo"
                                            placeholder="Mínimo" value="<?= $produto->PRO_MINIMO ?>">
                                        <label for="estoqueMinimo">Mínimo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Insira a descrição do produto"
                                            id="descricao" name="descricao"
                                            style="height: 100px"><?= $produto->PRO_DESCRICAO ?></textarea>
                                        <label for="descricao">Descrição</label>
                                    </div>
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
    <?php } ?>
    <!----------------------->

    <!-- DESATIVAR PRODUTO -->
    <?php foreach ($produtos as $indice => $produto) { ?>
        <div class="modal fade" id="desativarProdutoModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="desativarProdutoModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="desativarProdutoModalLabel<?= $indice ?>">Desativar Produto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container" method="post"
                            action="../../classes/Produto/produto.controller.php?acao=desativar&id=<?= $produto->PRO_ID ?>">
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <h4>Deseja desativar esse produto?</h4>
                            </div>

                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <button type="submit" class="btn btn-outline-success">Sim</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Não</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!----------------------->

    <!-- VER MAIS DETALHES -->
    <?php foreach ($produtos as $indice => $produto) { ?>
        <!-- VER MAIS DETALHES -->
        <div class="modal fade" id="visualizarDetalhesProdutoModal<?= $indice ?>" tabindex="-1"
            aria-labelledby="visualizarDetalhesProdutoModalLabel<?= $indice ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="visualizarDetalhesProdutoModalLabel<?= $indice ?>">Detalhes do
                            Produto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
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

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="cor" name="cor" placeholder="Cor"
                                            value="<?= $produto->PRO_COR ?>" disabled>
                                        <label for="cor">Cor</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="material" name="material"
                                            placeholder="Material" value="<?= $produto->PRO_MATERIAL ?>" disabled>
                                        <label for="material">Material</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="categoria" name="categoria"
                                            value="<?= $produto->PRO_CAT ?>" disabled>
                                        <label for="categoria">Categoria</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="detalhes" name="detalhes"
                                            placeholder="Detalhes" value="<?= $produto->PRO_DETALHES ?>" disabled>
                                        <label for="detalhes">Detalhes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">R$</span>
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="precoDeCompra" name="precoDeCompra"
                                                placeholder="Preço" value="<?= $produto->PRO_PRECO_CUSTO ?>" disabled>
                                            <label for="precoDeCompra">Preço</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="quantidadeEmEstoque"
                                            name="quantidadeEmEstoque" placeholder="Quantidade"
                                            value="<?= $produto->PRO_QUANTIDADE ?>" disabled>
                                        <label for="quantidadeEmEstoque">Quantidade</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="estoqueMinimo" name="estoqueMinimo"
                                            placeholder="Mínimo" value="<?= $produto->PRO_MINIMO ?>" disabled>
                                        <label for="estoqueMinimo">Mínimo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <?php if ($produto->PRO_STATUS == 0) { ?>
                                                <input class="form-control" type="text" id="status" name="status"
                                                    placeholder="Status" value="Desativado" disabled>
                                            <?php } else { ?>
                                                <input class="form-control" type="text" id="status" name="status"
                                                    placeholder="Status" value="Ativo" disabled>
                                            <?php } ?>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="empresa" name="empresa"
                                            placeholder="Empresa" value=" " disabled>
                                        <label for="empresa">Empresa</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Insira a descrição do produto"
                                            id="descricao" name="descricao" style="height: 100px"
                                            disabled><?= $produto->PRO_DESCRICAO ?></textarea>
                                        <label for="descricao">Descrição</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


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
                    <strong>Produto registrado com sucesso!</strong>
                </div>
            <?php } else if ($toastAcao === 'editar') { ?>
                    <div class="toast-header fs-5">
                        <i class="bi bi-square-fill text-primary"></i>
                        <strong class="me-auto ms-3">Editar</strong>
                        <button type="button" class="btn-close" onclick="closeToast()"></button>
                    </div>
                    <div class="toast-body fs-6">
                        <strong>Produto editado com sucesso!</strong>
                    </div>
            <?php } else if ($toastAcao === 'desativar') { ?>
                        <div class="toast-header fs-5">
                            <i class="bi bi-square-fill text-danger"></i>
                            <strong class="me-auto ms-3">Desativar</strong>
                            <button type="button" class="btn-close" onclick="closeToast()"></button>
                        </div>
                        <div class="toast-body fs-6">
                            <strong>Produto desativado com sucesso!</strong>
                        </div>
            <?php } else if ($toastAcao === 'ativar') { ?>
                            <div class="toast-header fs-5">
                                <i class="bi bi-square-fill text-success"></i>
                                <strong class="me-auto ms-3">Ativar</strong>
                                <button type="button" class="btn-close" onclick="closeToast()"></button>
                            </div>
                            <div class="toast-body fs-6">
                                <strong>Produto reativado com sucesso!</strong>
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