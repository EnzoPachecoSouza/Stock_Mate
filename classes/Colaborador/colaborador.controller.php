<?php

require "colaborador.model.php";
require "colaborador.service.php";
require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $colaborador = new Colaborador();

    $colaborador->__set('colaborador', $_POST['colaborador']);
    $colaborador->__set('email', $_POST['email']);
    $colaborador->__set('contato', $_POST['contato']);
    $colaborador->__set('cpf', $_POST['cpf']);
    $colaborador->__set('cargo', $_POST['cargo']);

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->inserir();

    header('Location: ../../pages/Colaborador/index.php?act=inserir');
} else if ($acao == 'recuperar') {
    $colaborador = new Colaborador();

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradores = $colaboradorService->recuperar();
} else if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : $id;
    $colaborador = new Colaborador();

    $colaborador->__set('colaborador', $_POST['colaborador']);
    $colaborador->__set('email', $_POST['email']);
    $colaborador->__set('contato', $_POST['contato']);
    $colaborador->__set('cpf', $_POST['cpf']);
    $colaborador->__set('cargo', $_POST['cargo']);

    $conexao = new Conexao();
    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->editar($id);

    header('Location: ../../pages/Colaborador/index.php?act=editar');
} else if ($acao == 'alterarSenha') {
    // ---
}
