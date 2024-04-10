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

    <!-- CADASTRAR PRODUTO -->
    
        <div class="modal-box">
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
                    <button class="btn btn-outline-primary">Criar produto</button>
                </div>
            </form>
        </div>
    </div> -->
    <!----------------------->

    <!-- EDITAR PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
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
    </div> -->
    <!----------------------->

    <!-- DESATIVAR PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
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
                    <button class="btn btn-outline-primary">Criar produto</button>
                </div>
            </form>
        </div>
    </div> -->
    <!----------------------->

    <!-- CADASTRAR PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
            <form class="container" action="">

            </form>
        </div>
    </div> -->
    <!----------------------->

    <!-- CADASTRAR PRODUTO -->
    <!-- <div class="modal">
        <div class="modal-box">
            <form class="container" action="">

            </form>
        </div>
    </div> -->
    <!----------------------->







    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>