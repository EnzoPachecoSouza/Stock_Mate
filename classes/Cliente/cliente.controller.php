<?php
require "cliente.model.php";
require "cliente.service.php";
require "../../classes/conexao.php";

// $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// if ($acao == 'inserir') {
//     $cliente = new Cliente();

//     $cliente->__set('nome', $_POST['cliente']);
//     $cliente->__set('email', $_POST['email']);
//     $cliente->__set('contato', $_POST['contato']);
//     $cliente->__set('cpf', $_POST['cpf']);

//     $conexao = new Conexao();

//     $clienteService = new ClienteService($conexao, $cliente);
//     $clienteService->inserir();

//     header('Location: ../../pages/Cliente/index.php?act=inserir');
// } else if ($acao == 'recuperar') {
//     $cliente = new Cliente();
//     $conexao = new Conexao();
//     $clienteService = new ClienteService($conexao, $cliente);
//     $clientes = $clienteService->recuperar();
// } else if ($acao == 'editar') {
//     $id = isset($_GET['id']) ? $_GET['id'] : $id;
//     $cliente = new Cliente();

//     $cliente->__set('nome', $_POST['cliente']);
//     $cliente->__set('email', $_POST['email']);
//     $cliente->__set('contato', $_POST['contato']);
//     $cliente->__set('cpf', $_POST['cpf']);

//     $conexao = new Conexao();
//     $clienteService = new ClienteService($conexao, $cliente);
//     $clienteService->editar($id);

//     header('Location: ../../pages/Cliente/index.php?act=editar');
// }

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $cliente = new Cliente();

    $cliente->__set('nome', $_POST['cliente']);
    $cliente->__set('email', $_POST['email']);
    $cliente->__set('contato', $_POST['contato']);
    $cliente->__set('cpf', $_POST['cpf']);

    $conexao = new Conexao();

    $clienteService = new ClienteService($conexao, $cliente);
    $clienteService->inserir();

    header('Location: ../../pages/Cliente/index.php?act=inserir');
} else if ($acao == 'recuperar') {
    $cliente = new Cliente();

    $conexao = new Conexao();

    $clienteService = new ClienteService($conexao, $cliente);
    $clientes = $clienteService->recuperar();
} else if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    $cliente = new Cliente();

    $cliente->__set('nome', $_POST['cliente']);
    $cliente->__set('email', $_POST['email']);
    $cliente->__set('contato', $_POST['contato']);
    $cliente->__set('cpf', $_POST['cpf']);

    $conexao = new Conexao();

    $clienteService = new ClienteService($conexao, $cliente);
    $clienteService->editar($id);

    header('Location: ../../pages/Cliente/index.php?act=editar');
}
?>