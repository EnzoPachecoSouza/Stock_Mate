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
        produtos(PRO_CODIGO, PRO_NOME, PRO_COR, PRO_MATERIAL, PRO_CAT, PRO_DETALHES, PRO_PRECO_CUSTO, PRO_QUANTIDADE, PRO_MINIMO, PRO_DESCRICAO)
        VALUES (:codigo, :nome, :cor, :material, :categoria, :detalhes, :precoDeCompra, :quantidadeEmEstoque, :estoqueMinimo, :descricao)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
        $stmt->bindValue(':nome', $this->produto->__get('nome'));
        $stmt->bindValue(':cor', $this->produto->__get('cor'));
        $stmt->bindValue(':material', $this->produto->__get('material'));
        $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
        $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));
        $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
        $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
        $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
        $stmt->bindValue(':descricao', $this->produto->__get('descricao'));

        $stmt->execute();
    }

    public function recuperar()
    {
        $query = '
        SELECT *
        FROM PRODUTOS
        ORDER BY PRO_STATUS DESC, PRO_NOME
        ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function editar($id)
    {
        $query = '
        UPDATE PRODUTOS
        SET PRO_CODIGO = :codigo,
            PRO_NOME = :nome,
            PRO_COR = :cor,
            PRO_MATERIAL = :material,
            PRO_CAT = :categoria,
            PRO_DETALHES = :detalhes,
            PRO_PRECO_CUSTO = :precoDeCompra,
            PRO_QUANTIDADE = :quantidadeEmEstoque,
            PRO_MINIMO = :estoqueMinimo,
            PRO_DESCRICAO = :descricao
        WHERE PRO_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
        $stmt->bindValue(':nome', $this->produto->__get('nome'));
        $stmt->bindValue(':cor', $this->produto->__get('cor'));
        $stmt->bindValue(':material', $this->produto->__get('material'));
        $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
        $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));
        $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
        $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
        $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
        $stmt->bindValue(':descricao', $this->produto->__get('descricao'));
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function desativar($id)
    {
        $query = '
        UPDATE PRODUTOS
        SET PRO_STATUS = :status
        WHERE PRO_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':status', 0);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    public function ativar($id)
    {
        $query = '
        UPDATE PRODUTOS
        SET PRO_STATUS = :status
        WHERE PRO_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':status', 1);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}
