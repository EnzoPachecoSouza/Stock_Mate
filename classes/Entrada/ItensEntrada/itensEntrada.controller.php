<?php
require "itensEntrada.model.php";
require "itensEntrada.service.php";
require __DIR__ . "/../../../classes/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'recuperar') {
    $itensEntrada = new ItensEntrada();

    $conexao = new Conexao();

    $itensEntradaService = new ItensEntradaService($conexao, $itensEntrada);
    $itensEntradaRecuperar = $itensEntradaService->recuperar();
}
