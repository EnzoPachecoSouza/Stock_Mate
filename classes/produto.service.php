<?php
//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER
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
        INSERT INTO
        produtos(PRO_CODIGO, PRO_NOME, PRO_MATERIAL, PRO_CATEGORIA, PRO_DESCRICAO, PRO_COR, PRO_MINIMO, PRO_QUANTIDADE, PRO_PRECO_CUSTO, PRO_DETALHES)
        VALUES (:codigo, :nome, :material, :categoria, :descricao, :cor, :estoqueMinimo, :quantidadeEmEstoque, :precoDeCompra, :detalhes)
    ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
        $stmt->bindValue(':nome', $this->produto->__get('nome'));
        $stmt->bindValue(':material', $this->produto->__get('material'));
        $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
        $stmt->bindValue(':descricao', $this->produto->__get('descricao'));
        $stmt->bindValue(':cor', $this->produto->__get('cor'));
        $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
        $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
        $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
        $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));

        $stmt->execute(); 
    }

}

// private $conexao;
// private $produto;

// public function __construct(Conexao $conexao, Produto $produto)
// {
//     $this->conexao = $conexao->conectar();
//     $this->produto = $produto;
// }

// public function inserir()
// {
//     $query = '
//         INSERT INTO produtos(produto)values(:produto)
//     ';

//     $stmt = $this->conexao->prepare($query);

//     $stmt->bindValue(':produto', $this->produto->__get('produto'));
//     $stmt->execute();
// }
//}