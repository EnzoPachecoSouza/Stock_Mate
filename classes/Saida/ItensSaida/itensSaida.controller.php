<?php
require "itensSaida.model.php";
require "itensSaida.service.php";
require __DIR__ . "/../../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'recuperar') {
    $itensSaida = new ItensSaida();

    $conexao = new Conexao();

    $itensSaidaService = new ItensSaidaService($conexao, $itensSaida);
    $itensSaidaRecuperar = $itensSaidaService->recuperar();
}
