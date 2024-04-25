<?php

require "./produto.model.php";
require "./produto.service.php";
require "./conexao.php";

// //recebe a ação através do action do form
// $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// if ($acao == 'inserir') {
//      //instância o objeto do produto.model.php
//     $tarefa = new Tarefa();
//      //faz a atribuição do produto pelo __set no produto.model.php
//     $tarefa->__set('tarefa', $_POST['tarefa']); 

//      //inicia conexão com o BD
//     $conexao = new Conexao(); 

//      //instancia o objeto ProdutoService do produto.service.php com a conexao do BD e o produto a ser criado
//     $tarefaService = new TarefaService($conexao, $tarefa); 
//      //ação a ser executa no produto.service.php que faz a requisição para o BD
//     $tarefaService->inserir(); 

//      //retorna para a tela passando parametro na url para mostrar uma label dinamica dizendo que o produto foi registrado
//     header('Location: nova_tarefa.php?inclusao=1'); 
// }