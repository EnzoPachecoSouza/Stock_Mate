<?php
require "entrada.model.php";
require "ItensEntrada/itensEntrada.model.php";
require "entrada.service.php";
require "ItensEntrada/itensEntrada.service.php";
require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $entrada = new Entrada();
    $itensEntrada = new ItensEntrada();

    $entrada->__set('dataCompra', $_POST['dataCompra']);
    $entrada->__set('valorTotal', $_POST['valorTotal']);
    $entrada->__set('dataPagamento', $_POST['dataPagamento']);
    $entrada->__set('fornecedor', $_POST['fornecedor']);
    $entrada->__set('formaPagamento', $_POST['formaPagamento']);

    $selectedProducts = json_decode($_POST['selectedProducts'], true);

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradaService->inserir();
    $entradaID = $entradaService->getID();

    if (json_last_error() === JSON_ERROR_NONE) {

        foreach ($selectedProducts as $produto) {
            $itensEntrada->__set('entradaID', $entradaID);
            $itensEntrada->__set('produtoID', $produto['id']);
            $itensEntrada->__set('produtoQuantidade', $produto['quantidade']);

            $itensEntradaService = new ItensEntradaService($conexao, $itensEntrada);
            $itensEntradaService->inserir();
        }

        header('Location: ../../pages/Entrada/index.php?act=inserir');
    } else {
        echo 'Erro na decodificação do JSON: ' . json_last_error_msg();
    }
} else if ($acao == 'recuperar') {
    $entrada = new Entrada();

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradas = $entradaService->recuperar();
} else if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    $entrada = new Entrada();

    $entrada->__set('dataCompra', $_POST['dataCompra']);
    $entrada->__set('valorTotal', $_POST['valorTotal']);
    $entrada->__set('dataPagamento', $_POST['dataPagamento']);
    $entrada->__set('formaPagamento', $_POST['formaPagamento']);
    $entrada->__set('fornecedor', $_POST['fornecedor']);

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradaService->editar($id);

    header('Location: ../../pages/Entrada/index.php?act=editar');
}
