<?php

require "saida.model.php";
require "ItensSaida/itensSaida.model.php";
require "../../classes/Produto/produto.model.php";

require "saida.service.php";
require "ItensSaida/itensSaida.service.php";
require "../../classes/Produto/produto.service.php";

require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $saida = new Saida();
    $itensSaida = new ItensSaida();

    $saida->__set('dataVenda', $_POST['dataVenda']);
    $saida->__set('valorTotal', $_POST['valorTotal']);
    $saida->__set('dataPagamento', $_POST['dataPagamento']);
    $saida->__set('cliente', $_POST['cliente']);
    $saida->__set('formaPagamento', $_POST['formaPagamento']);

    $selectedProducts = json_decode($_POST['selectedProducts'], true);

    $conexao = new Conexao();

    $saidaService = new SaidaService($conexao, $saida);

    $saidaService->inserir();
    $saidaID = $saidaService->getID();

    if (json_last_error() === JSON_ERROR_NONE) {

        foreach ($selectedProducts as $produto) {
            $produtoAtualizar = new Produto();
            $produtoService = new ProdutoService($conexao, $produtoAtualizar);

            $itensSaida->__set('saidaID', $saidaID);
            $itensSaida->__set('produtoID', $produto['id']);
            $itensSaida->__set('produtoQuantidade', $produto['quantidade']);

            $itensSaidaService = new ItensSaidaService($conexao, $itensSaida);
            $itensSaidaService->inserir();

            $produtoService->atualizarSaida($produto['id'], $produto['quantidade']);
        }

        header('Location: ../../pages/Saida/index.php?act=inserir');
    } else {
        echo 'Erro na decodificação do JSON: ' . json_last_error_msg();
    }
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
