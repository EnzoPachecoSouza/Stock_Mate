<?php

class ProdutoService
{
    private $conexao;
    private $produto;

    public function __construct(Conexao $conexao, Produto $produto)
    {
        $this->conexao = $conexao->conectar();
        $this->produto = $produto;
    }

    public function inserir()
    {
        $query = '
            INSERT INTO produtos(produto)values(:produto)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':produto', $this->produto->__get('produto'));
        $stmt->execute();
    }
}