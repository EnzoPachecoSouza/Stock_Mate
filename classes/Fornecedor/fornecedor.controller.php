<?php

require "fornecedor.model.php";
require "fornecedor.service.php";
require "../../classes/conexao.php";

//recebe a ação através do action do form
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir' || $acao == 'inserir-from-entrada') {
    $fornecedor = new Fornecedor();

    $fornecedor->__set('fornecedor', $_POST['fornecedor']);
    $fornecedor->__set('email', $_POST['email']);
    $fornecedor->__set('contato', $_POST['contato']);
    $fornecedor->__set('cnpj', $_POST['cnpj']);

    $conexao = new Conexao();

    $fornecedorService = new FornecedorService($conexao, $fornecedor);
    $fornecedorService->inserir();

    if ($acao == 'inserir') {
        header('Location: ../../pages/Fornecedor/index.php?act=inserir');
    } else if($acao == 'inserir-from-entrada'){
        header('Location: ../../pages/Entrada/index.php?act=inserir-fornecedor');
    }
} else if ($acao == 'recuperar') {
    //instancia o objeto do produto.model.php
    $fornecedor = new Fornecedor();

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser recuperado
    $fornecedorService = new FornecedorService($conexao, $fornecedor);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $fornecedores = $fornecedorService->recuperar();
} else if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;
    $fornecedor = new Fornecedor();

    $fornecedor->__set('fornecedor', $_POST['fornecedor']);
    $fornecedor->__set('email', $_POST['email']);
    $fornecedor->__set('contato', $_POST['contato']);
    $fornecedor->__set('cnpj', $_POST['cnpj']);

    $conexao = new Conexao();
    $fornecedorService = new FornecedorService($conexao, $fornecedor);
    $fornecedorService->editar($id);

    header('Location: ../../pages/Fornecedor/index.php?act=editar');
}