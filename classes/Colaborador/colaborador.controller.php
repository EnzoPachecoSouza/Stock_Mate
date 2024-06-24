<?php

require "colaborador.model.php";
require "colaborador.service.php";
require "../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $colaborador = new Colaborador();

    // Função para criptografar a senha
    function criptografarSenha($senha) {
        return hash('sha256', $senha);
    }

    // Senha criptografada
    $senhaCriptografada = criptografarSenha($_POST['senha']);

    $colaborador->__set('colaborador', $_POST['colaborador']);
    $colaborador->__set('email', $_POST['email']);
    $colaborador->__set('contato', $_POST['contato']);
    $colaborador->__set('cpf', $_POST['cpf']);
    $colaborador->__set('senha', $senhaCriptografada);
    $colaborador->__set('cargo', $_POST['cargo']);

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->inserir();

    header('Location: ../../pages/Colaborador/index.php?act=inserir');
}else if ($acao == 'recuperar') {
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
    $id = isset($_GET['id']) ? $_GET['id'] : $id;
    $colaborador = new Colaborador();

    // Função para criptografar a senha
    function criptografarSenha($senha) {
        return hash('sha256', $senha);
    }

    // Criptografar a nova senha
    $novaSenhaCriptografada = criptografarSenha($_POST['novaSenha']);

    $colaborador->__set('senha', $novaSenhaCriptografada);

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->alterarSenha($id);

    header('Location: ../../pages/Estoque/index.php?act=alterarSenha');
}



