<?php

require "./produto.model.php";
require "./produto.service.php";
require "./conexao.php";


$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao == 'inserir') {
    $produto = new Produto();
    $produto->__set('codigo', $_POST['codigo']);
    $produto->__set('nome', $_POST['nome']);
    $produto->__set('cor', $_POST['cor']);
    $produto->__set('material', $_POST['material']);
    $produto->__set('categoria', $_POST['categoria']);
    $produto->__set('detalhes', $_POST['detalhes']);
    $produto->__set('precoDeCompra', $_POST['precoDeCompra']);
    $produto->__set('quantidadeEmEstoque', $_POST['quantidadeEmEstoque']);
    $produto->__set('estoqueMinimo', $_POST['estoqueMinimo']);
    $produto->__set('descricao', $_POST['descricao']);

    // Cria uma instância de Conexao
    $conexaoObj = new Conexao();
    // Chama o método conectar para obter a conexão PDO
    $conexao = $conexaoObj->conectar();

    $produtoService = new ProdutoService($conexao, $produto);
    $produtoService->inserir();

    // Redirecionamento após a inserção (descomente se desejar)
    // header('Location: novo_produto.php?inclusao=1');
}


// //recebe a ação através do action do form
// $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// if ($acao == 'inserir') {
//     //instância o objeto do produto.model.php
//     $produto = new Produto();
//     //faz a atribuição do atributo pelo __set no produto.model.php
//     $produto->__set('codigo', $_POST['codigo']);
//     $produto->__set('nome', $_POST['nome']);
//     $produto->__set('cor', $_POST['cor']);
//     $produto->__set('material', $_POST['material']);
//     $produto->__set('categoria', $_POST['categoria']);
//     $produto->__set('detalhes', $_POST['detalhes']);
//     $produto->__set('precoDeCompra', $_POST['preco-de-compra']);
//     $produto->__set('quantidadeEmEstoque', $_POST['quantidade']);
//     $produto->__set('estoqueMinimo', $_POST['minimo']);
//     $produto->__set('descricao', $_POST['descricao']);

//     //inicia conexão com o BD
//     $conexao = new Conexao();

//     //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser criado
//     $produtoService = new produtoService($conexao, $produto);
//     //ação a ser executa no produto.service.php que faz a requisição para o BD
//     $produtoService->inserir();

//     //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi registrado
//     // header('Location: novo_produto.php?inclusao=1');
//}