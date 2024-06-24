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


function criarSenha()
{
    $caracteresEspeciais = array('!', '@', '#', '$', '%', '&', '*', '?', '(', ')', '[', ']', '{', '}');
    $letrasMinusculas = range('a', 'z');
    $letrasMaiusculas = range('A', 'Z');
    $numeros = range('0', '9');

    $senha = '';
    $senha .= $caracteresEspeciais[array_rand($caracteresEspeciais)];
    $senha .= $letrasMinusculas[array_rand($letrasMinusculas)];
    $senha .= $letrasMaiusculas[array_rand($letrasMaiusculas)];
    $senha .= $numeros[array_rand($numeros)];

    for ($i = 0; $i < 6; $i++) {
        $grupoAleatorio = mt_rand(0, 2);
        switch ($grupoAleatorio) {
            case 0:
                $senha .= $letrasMinusculas[array_rand($letrasMinusculas)];
                break;
            case 1:
                $senha .= $letrasMaiusculas[array_rand($letrasMaiusculas)];
                break;
            case 2:
                $senha .= $numeros[array_rand($numeros)];
                break;
        }
    }

    $senhaEmbaralhada = str_shuffle($senha);

    return $senhaEmbaralhada;
}


