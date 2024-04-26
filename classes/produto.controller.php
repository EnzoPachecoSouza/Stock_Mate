<?php

require "./produto.model.php";
require "./produto.service.php";
require "./conexao.php";

//recebe a ação através do action do form
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    //instância o objeto do produto.model.php
    $produto = new Produto();
    //faz a atribuição do atributo pelo __set no produto.model.php
    $produto->__set('codigo', $_POST['codigo']);
    $produto->__set('nome', $_POST['nome']);
    $produto->__set('material', $_POST['material']);
    $produto->__set('categoria', $_POST['categoria']);
    $produto->__set('descricao', $_POST['descricao']);
    $produto->__set('cor', $_POST['cor']);
    $produto->__set('estoqueMinimo', $_POST['estoqueMinimo']);
    $produto->__set('quantidadeEmEstoque', $_POST['quantidadeEmEstoque']);
    $produto->__set('precoDeCompra', $_POST['precoDeCompra']);
    $produto->__set('detalhes', $_POST['detalhes']);

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser criado
    $produtoService = new produtoService($conexao, $produto);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $produtoService->inserir();

    //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi registrado
    // header('Location: novo_produto.php?inclusao=1');
}