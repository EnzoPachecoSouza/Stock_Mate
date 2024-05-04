<?php

require "entrada.model.php";
require "entrada.service.php";
require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $entrada = new Entrada();

    $entrada->__set('dataCompra', $_POST['dataCompra']);
    $entrada->__set('valorTotal', $_POST['valorTotal']);
    $entrada->__set('dataPagamento', $_POST['dataPagamento']);
    // $entrada->__set('fornecedor', $_POST['fornecedor']);
    $entrada->__set('formaPagamento', $_POST['formaPagamento']);

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradaService->inserir();

    header('Location: ../../pages/Entrada/index.php?act=inserir');
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
    // $entrada->__set('fornecedor', $_POST['fornecedor']);
    $entrada->__set('formaPagamento', $_POST['formaPagamento']);

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradaService->editar($id);

    header('Location: ../../pages/Entrada/index.php?act=editar');
} else if ($acao == 'desativar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    $entrada = new Entrada();

    $entrada->__set('status', 0);

    $conexao = new Conexao();

    $entradaService = new EntradaService($conexao, $entrada);
    $entradaService->desativar($id);

    header('Location: ../../pages/Entrada/index.php?act=desativar');
}