<?php
date_default_timezone_set('America/Sao_Paulo');

include ('../Login/session_check.php');

$acao = 'recuperar';

require '../../classes/Colaborador/colaborador.controller.php';
?>

<?php if ($_SESSION['cargo'] === 'Gerente') { ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StockMate | Colaborador</title>

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
                                    <a class="nav-link text-white nav-font selected" href="../colaborador">Colaboradores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white nav-font" href="../relatorio">Relatórios</a>
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
                    <a class="nav-link text-white nav-font selected" href="../colaborador">Colaboradores</a>
                </li>
                <li class="nav-item d-flex mb-1">
                    <a class="nav-link text-white nav-font" href="../relatorio">Relatórios</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!------->

    <div class="container mt-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- BOTÃO DE CADASTRAR COLABORADOR -->
                    <div class="col-12 col-md-2 mb-2 d-flex justify-content-center justify-content-md-start">
                        <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal"
                            data-bs-target="#cadastrarColaboradorModal">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <!------->

                <div class="col-12 col-md-10">
                    <div class="row g-2 justify-content-end">
                        <div class="col-12 col-sm-8 col-md-8 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" placeholder="Pesquisar"
                                    id="pesquisar" name="pesquisar">
                                <button onclick="pesquisarDados()" class="btn btn-primary" type="button"
                                    id="button-addon2">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ps-1 mt-3" style="height: 70vh; overflow: auto;">
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
                            <th scope="col">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex flex-column">
                                        <i onclick="filtrarDados(9)" id="filtro" name="filtro"
                                            class="order-hover bi bi-chevron-up"></i>
                                        <i onclick="filtrarDados(10)" id="filtro" name="filtro"
                                            class="order-hover bi bi-chevron-down"></i>
                                    </div>
                                    Cargo
                                </div>
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody class="table-group-divider table-hover-shadow">
                        <!-- TABELA MAPEADA -->
                        <?php foreach ($colaboradores as $indice => $colaborador) { ?>
                            <?php if ($colaborador->COL_STATUS == 0) { ?>
                                <tr class="table-active">
                                <?php } else { ?>
                                <tr>
                                <?php } ?>
                                <th scope="row" class="">
                                    <?= $colaborador->COL_NOME ?>
                                </th>
                                <td>
                                    <?= $colaborador->COL_EMAIL ?>
                                </td>

                                <td>
                                    <?= $colaborador->COL_CONTATO ?>
                                </td>

                                <td>
                                    <?= $colaborador->COL_CPF ?>
                                </td>

                                <td>
                                    <?= $colaborador->COL_CARGO ?>
                                </td>


                                <td class="text-center fs-4 d-flex justify-content-center align-items-center gap-3">
                                    <!-- BOTÃO EDITAR COLABORADOR -->
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#editarColaboradorModal<?= $indice ?>">
                                        <i class="bi bi-pencil-square text-info fs-5"></i>
                                    </button>
                                    <!------->

                            <!-- BOTÃO DESATIVAR PRODUTO -->
                                    <?php if ($colaborador->COL_CARGO === 'Funcionário') { ?>
                                        <?php if ($colaborador->COL_STATUS === 1) { ?>
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#desativarColaboradorModal<?= $indice ?>">
                                                <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                            </button>
                                        <?php } else { ?>
                                            <form method="post"
                                                action="../../classes/Colaborador/colaborador.controller.php?acao=ativar&id=<?= $colaborador->COL_ID ?>">
                                                <button type="submit" class="btn">
                                                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if ($colaborador->COL_STATUS === 1) { ?>
                                            <button type="button" class="btn invisible" data-bs-toggle="modal"
                                                data-bs-target="#desativarColaboradorModal<?= $indice ?>">
                                                <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                            </button>
                                        <?php } else { ?>
                                            <form method="post" class="invisible"
                                                action="../../classes/Colaborador/colaborador.controller.php?acao=ativar&id=<?= $colaborador->COL_ID ?>">
                                                <button type="submit" class="btn">
                                                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                                </button>
                                            </form>
                                        <?php } ?>
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

    <!-- CADASTRAR COLABORADOR -->
        <div class="modal fade" id="cadastrarColaboradorModal" tabindex="-1"
            aria-labelledby="cadastrarColaboradorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastrarColaboradorModalLabel">Registrar Colaborador</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="container needs-validation" novalidate method="post"
                            action="../../classes/Colaborador/colaborador.controller.php?acao=inserir">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="colaborador" name="colaborador"
                                                placeholder="Nome" required>
                                            <label for="colaborador">Nome</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="contato" name="contato"
                                            placeholder="Contato" required>
                                        <label for="contato">Contato</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail"
                                            required>
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" id="cpf" name="cpf" placeholder="CPF"
                                            required>
                                        <label for="cpf">CPF</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="senha" name="senha"
                                                placeholder="Senha" required readonly>
                                            <span onclick="criarSenha()" class="input-group-text"><i
                                                    class="bi bi-arrow-clockwise"></i></span>
                                            <span onclick="copiarSenha()" class="input-group-text" id="copiarSenha"><i
                                                    class="bi bi-copy"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-select shadow-none" id="cargo" name="cargo" required>
                                            <option value="" disabled selected>Cargo</option>
                                            <option value="Gerente">Gerente</option>
                                            <option value="Funcionário">Funcionário</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-primary">Registrar Colaborador</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------->

    <script>
        const senhaInput = document.querySelector('#senha');
        const copiarSenhaInput = document.querySelector('#copiarSenha');

        function criarSenha() {
            const caracteresEspeciais = ['!', '@', '#', '$', '%', '&', '*', '?', '(', ')', '[', ']', '{', '}'];
            const letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz'.split('');
            const letrasMaiusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
            const numeros = '0123456789'.split('');

            let senha = '';
            senha += caracteresEspeciais[Math.floor(Math.random() * caracteresEspeciais.length)];
            senha += letrasMinusculas[Math.floor(Math.random() * letrasMinusculas.length)];
            senha += letrasMaiusculas[Math.floor(Math.random() * letrasMaiusculas.length)];
            senha += numeros[Math.floor(Math.random() * numeros.length)];

            for (let i = 0; i < 6; i++) {
                const grupoAleatorio = Math.floor(Math.random() * 3);
                switch (grupoAleatorio) {
                    case 0:
                        senha += letrasMinusculas[Math.floor(Math.random() * letrasMinusculas.length)];
                        break;
                    case 1:
                        senha += letrasMaiusculas[Math.floor(Math.random() * letrasMaiusculas.length)];
                        break;
                    case 2:
                        senha += numeros[Math.floor(Math.random() * numeros.length)];
                        break;
                }
            }

            const senhaEmbaralhada = senha.split('').sort(() => 0.5 - Math.random()).join('');

            copiarSenhaInput.classList.remove('bg-success', 'text-white')
            senhaInput.value = senhaEmbaralhada;
        }

        function copiarSenha() {
            navigator.clipboard.writeText(senhaInput.value).then(function () {
                console.log('Senha copiada com sucesso!');
                copiarSenhaInput.classList.add('bg-success', 'text-white')
            }, function (err) {
                console.log('Erro ao tentar copiar a senha:', err);
            });
        }
    </script>


    <!-- EDITAR COLABORADOR -->
        <?php foreach ($colaboradores as $indice => $colaborador) { ?>
            <div class="modal fade" id="editarColaboradorModal<?= $indice ?>" tabindex="-1"
                aria-labelledby="editarColaboradorModalLabel<?= $indice ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editarColaboradorModalLabel<?= $indice ?>">Editar Colaborador</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="container needs-validation" novalidate method="post"
                                action="../../classes/Colaborador/colaborador.controller.php?acao=editar&id=<?= $colaborador->COL_ID ?>">
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="colaborador" name="colaborador"
                                                placeholder="Nome" value="<?= $colaborador->COL_NOME ?>" required>
                                            <label for="colaborador">Nome</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="email" name="email" placeholder="E-mail"
                                                value="<?= $colaborador->COL_EMAIL ?>" required>
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="contato" name="contato"
                                                placeholder="Contato" value="<?= $colaborador->COL_CONTATO ?>" required>
                                            <label for="contato">Contato</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="cpf" name="cpf" placeholder="CPF"
                                                value="<?= $colaborador->COL_CPF ?>" required>
                                            <label for="cpf">CPF</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="senhaEditar" name="senha"
                                                    placeholder="Senha" required readonly>
                                                <span onclick="criarSenhaEditar()" class="input-group-text"><i
                                                        class="bi bi-arrow-clockwise"></i></span>
                                                <span onclick="copiarSenhaEditar()" class="input-group-text"
                                                    id="copiarSenhaEditar"><i class="bi bi-copy"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select class="form-select shadow-none" id="cargo" name="cargo" required>
                                                <option value="<?= $colaborador->COL_CARGO ?>" selected></option>
                                                <option value="Gerente">Gerente</option>
                                                <option value="Funcionário">Funcionário</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="d-flex justify-content-center align-items-center">
                                    <button class="btn btn-outline-primary">Editar colaborador</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!----------------------->

    <!-- DESATIVAR PRODUTO -->
        <?php foreach ($colaboradores as $indice => $colaborador) { ?>
            <div class="modal fade" id="desativarColaboradorModal<?= $indice ?>" tabindex="-1"
                aria-labelledby="desativarColaboradorModalLabel<?= $indice ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="desativarColaboradorModalLabel<?= $indice ?>">Desativar Colaborador
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="container" method="post"
                                action="../../classes/Colaborador/colaborador.controller.php?acao=desativar&id=<?= $colaborador->COL_ID ?>">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <h4>Deseja desativar esse colaborador?</h4>
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
                        <strong>Colaborador registrado com sucesso!</strong>
                    </div>
                <?php } else if ($toastAcao === 'editar') { ?>
                        <div class="toast-header fs-5">
                            <i class="bi bi-square-fill text-primary"></i>
                            <strong class="me-auto ms-3">Editar</strong>
                            <button type="button" class="btn-close" onclick="closeToast()"></button>
                        </div>
                        <div class="toast-body fs-6">
                            <strong>Colaborador editado com sucesso!</strong>
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
                <?php } else if ($toastAcao === 'desativar') { ?>
                                <div class="toast-header fs-5">
                                    <i class="bi bi-square-fill text-danger"></i>
                                    <strong class="me-auto ms-3">Desativar</strong>
                                    <button type="button" class="btn-close" onclick="closeToast()"></button>
                                </div>
                                <div class="toast-body fs-6">
                                    <strong>Colaborador desativado com sucesso!</strong>
                                </div>
                <?php } ?>
            </div>
        </div>
        <!----------------------->

<!-- ALTERAR SENHA -->
<div class="modal fade" id="alterarSenhaModal" tabindex="-1" aria-labelledby="alterarSenhaModalLabel" aria-hidden="true">
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
                            <div class="input-group">
                                <input class="form-control shadow-none" type="password" id="senhaAtual" name="senhaAtual"
                                    placeholder="Senha Atual" oninput="verificaSenha(this.value)" required>
                                <span class="input-group-text btn btn-primary" onclick="mostrarSenhas()">
                                    <i id="senhaIcon" class="bi bi-eye-fill fs-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input class="form-control" type="password" id="novaSenha" name="novaSenha"
                                    placeholder="Senha Nova" disabled required oninput="validaSenha()">
                                <label for="novaSenha">Senha Nova</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input class="form-control" type="password" id="confirmarSenhaNova" name="confirmarSenhaNova"
                                    placeholder="Confirme a Senha Nova" disabled required oninput="validaSenha()">
                                <label for="confirmarSenhaNova">Confirme a Senha Nova</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <span id="senha-erro" class="text-danger" style="display:none;">As senhas não coincidem.</span>
                            <span id="senha-requisitos" class="text-danger" style="display:none;">A senha deve ter no mínimo 8 caracteres, conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-5">
                        <button class="btn btn-outline-primary" type="submit" id="alterarSenhaBtn" disabled>Alterar Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const senhaAtual = "<?= $_SESSION['senha'] ?>";
    const senhaAtualInput = document.querySelector('#senhaAtual');
    const senhaNovaInput = document.querySelector('#novaSenha');
    const senhaNovaConfirmaInput = document.querySelector('#confirmarSenhaNova');
    const alterarSenhaBtn = document.querySelector('#alterarSenhaBtn');
    const senhaIcon = document.querySelector('#senhaIcon');

    let senhaVisivel = false;

    function verificaSenha(senha) {
        if (senha === senhaAtual) {
            senhaNovaInput.removeAttribute('disabled');
            senhaNovaConfirmaInput.removeAttribute('disabled');
        } else {
            senhaNovaInput.setAttribute('disabled', 'true');
            senhaNovaConfirmaInput.setAttribute('disabled', 'true');
        }
    }

    function verificaRequisitosSenha(senha) {
        const requisitos = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return requisitos.test(senha);
    }

    function validaSenha() {
        const senhaValida = verificaRequisitosSenha(senhaNovaInput.value);
        const senhasIguais = senhaNovaInput.value === senhaNovaConfirmaInput.value;

        if (!senhaValida) {
            document.querySelector('#senha-requisitos').style.display = 'block';
        } else {
            document.querySelector('#senha-requisitos').style.display = 'none';
        }

        if (senhasIguais) {
            document.querySelector('#senha-erro').style.display = 'none';
        } else {
            document.querySelector('#senha-erro').style.display = 'block';
        }

        if (senhaValida && senhasIguais) {
            alterarSenhaBtn.removeAttribute('disabled');
        } else {
            alterarSenhaBtn.setAttribute('disabled', 'true');
        }
    }

    function mostrarSenhas() {
        senhaVisivel = !senhaVisivel;
        const tipo = senhaVisivel ? 'text' : 'password';
        senhaAtualInput.type = tipo;
        senhaNovaInput.type = tipo;
        senhaNovaConfirmaInput.type = tipo;
        senhaIcon.classList.toggle('bi-eye-fill', !senhaVisivel);
        senhaIcon.classList.toggle('bi-eye-slash-fill', senhaVisivel);
    }
</script>
<!------------->


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