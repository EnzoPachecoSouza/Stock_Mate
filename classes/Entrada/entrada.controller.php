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
}