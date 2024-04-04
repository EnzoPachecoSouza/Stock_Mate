<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMate</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../../styles/styles.css">
</head>

<body>
    <div class="container-fluid bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <img src="" alt="[Logo] Stock Mate">
                </div>

                <div class="col-6">
                    <ul class="nav justify-content-center align-items-center">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Colaboradores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Estoque</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Relatórios</a>
                        </li>
                    </ul>
                </div>

                <div class="col-3 text-end">
                    <button class="btn btn-lg">Sair</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-center align-items-center gap-3">
            <button class="btn btn-lg btn-primary">Entrada</button>
            <button class="btn btn-lg btn-primary">Saída</button>
            <button class="btn btn-lg btn-primary">Criar</button>
        </div>
    </div>

    <?php
    // require './Components/cadastrar_produto.php'
    // require './Components/editar_produto.php'
    // require './Components/excluir_produto.php'
    // require './Components/entrada_produto.php'
        // >> FAZER MODAL DE SAÍDA <<
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>