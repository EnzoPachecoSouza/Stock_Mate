<?php

class ProdutoService
{
    private $conexao;
    private $produto;

    private function __construct(Conexao $conexao, Produto $produto)
    {
        $this->conexao = $conexao->conectar();
        $this->produto = $produto;
    }
}