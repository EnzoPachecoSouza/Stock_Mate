<?php

require "saida.model.php";
require "saida.service.php";
require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $saida = new Saida();

    $saida->__set('dataVenda', $_POST['dataVenda']);
    $saida->__set('valorTotal', $_POST['valorTotal']);
    $saida->__set('dataPagamento', $_POST['dataPagamento']);
    $saida->__set('cliente', $_POST['cliente']);
    $saida->__set('formaPagamento', $_POST['formaPagamento']);

    $conexao = new Conexao();

    $saidaService = new SaidaService($conexao, $saida);
    $saidaService->inserir();

    header('Location: ../../pages/Saida/index.php?act=inserir');
} else if ($acao == 'recuperar') {
    $saida = new Saida();

    $conexao = new Conexao();

    $saidaService = new SaidaService($conexao, $saida);
    $saidas = $saidaService->recuperar();
} else if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    $saida = new Saida();

    $saida->__set('dataVenda', $_POST['dataVenda']);
    $saida->__set('valorTotal', $_POST['valorTotal']);
    $saida->__set('dataPagamento', $_POST['dataPagamento']);
    $saida->__set('formaPagamento', $_POST['formaPagamento']);
    $saida->__set('cliente', $_POST['cliente']);

    $conexao = new Conexao();

    $saidaService = new SaidaService($conexao, $saida);
    $saidaService->editar($id);

    header('Location: ../../pages/Saida/index.php?act=editar');
}