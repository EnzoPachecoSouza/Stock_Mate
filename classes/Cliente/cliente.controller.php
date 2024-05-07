<?php

require "cliente.model.php";
require "cliente.service.php";
require "../../classes/conexao.php";

//recebe a ação através do action do form
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'recuperar') {
    //instancia o objeto do produto.model.php
    $cliente = new Cliente();

    //inicia conexão com o BD
    $conexao = new Conexao();

    //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser recuperado
    $clienteService = new ClienteService($conexao, $cliente);
    //ação a ser executa no produto.service.php que faz a requisição para o BD
    $clientes = $clienteService->recuperar();
}