<?php

require "produto.model.php";
require "produto.service.php";
require "../../classes/conexao.php";

//recebe a ação através do action do form
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    //instancia o objeto do produto.model.php
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
    header('Location: ../../pages/Estoque/index.php?act=inserir');

} else if ($acao == 'recuperar') {
    //instancia o objeto do produto.model.php
    $produto = new Produto();

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser recuperado
    $produtoService = new ProdutoService($conexao, $produto);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $produtos = $produtoService->recuperar();

} else if ($acao == 'editar') {
    //recebe o id do produto a ser editado
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    //instancia o objeto do produto.model.php
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

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser editado
    $produtoService = new ProdutoService($conexao, $produto);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $produtoService->editar($id);

    //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi editado
    header('Location: ../../pages/Estoque/index.php?act=editar');

} else if ($acao == 'desativar') {
    //recebe o id do produto a ser desativado
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    //instancia o objeto do produto.model.php
    $produto = new Produto();

    //faz a atribuição do atributo pelo __set no produto.model.php
    $produto->__set('status', 0);

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser desativado
    $produtoService = new ProdutoService($conexao, $produto);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $produtoService->desativar($id);

    //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi desativado
    header('Location: ../../pages/Estoque/index.php?act=desativar');

} else if ($acao == 'ativar') {
    //recebe o id do produto a ser desativado
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    //instancia o objeto do produto.model.php
    $produto = new Produto();

    //faz a atribuição do atributo pelo __set no produto.model.php
    $produto->__set('status', 1);

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser desativado
    $produtoService = new ProdutoService($conexao, $produto);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $produtoService->ativar($id);

    //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi desativado
    header('Location: ../../pages/Estoque/index.php?act=ativar');

}