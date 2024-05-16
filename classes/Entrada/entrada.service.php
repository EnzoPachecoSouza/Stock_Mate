<?php

class EntradaService
{

    private $conexao;
    private $entrada;

    public function __construct(Conexao $conexao, Entrada $entrada)
    {
        $this->conexao = $conexao->conectar();
        $this->entrada = $entrada;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        ENTRADA(ENT_DATA_COMPRA, ENT_VALOR_TOTAL, ENT_DATA_PAGAMENTO, ENT_FORMA_PAGAMENTO, FORNECEDORES_FOR_ID)
        VALUES (:dataCompra, :valorTotal, :dataPagamento, :formaPagamento, :fornecedor)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataCompra', $this->entrada->__get('dataCompra'));
        $stmt->bindValue(':valorTotal', $this->entrada->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->entrada->__get('dataPagamento'));
        $stmt->bindValue(':formaPagamento', $this->entrada->__get('formaPagamento'));
        $stmt->bindValue(':fornecedor', $this->entrada->__get('fornecedor'));

        $stmt->execute();
    }

    public function recuperar()
    {
        //VAI MOSTRAR DE ACORDO COM A PESQUISA DA FUNÇÃO DE PESQUISAR NOME NO JS
        
        if (!empty($_GET['search'])) {
            $pesquisaProduto = $_GET['search'];

            $query = "
            SELECT ENT.*, FORN.FOR_NOME
            FROM ENTRADA AS ENT
            INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
            WHERE FORN.FOR_NOME LIKE '%$pesquisaProduto%' 
            OR ENT.ENT_FORMA_PAGAMENTO LIKE '%$pesquisaProduto%'
            OR ENT.ENT_DATA_COMPRA LIKE '%$pesquisaProduto%'
            ";
        } else {
            
            $query = '
            SELECT ENT.*, FORN.FOR_NOME
            FROM ENTRADA AS ENT
            INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID;
            ';
        }

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function editar($id)
    {
        $query = '
        UPDATE ENTRADA
        SET ENT_DATA_COMPRA = :dataCompra,
            ENT_VALOR_TOTAL = :valorTotal,
            ENT_DATA_PAGAMENTO = :dataPagamento,
            ENT_FORMA_PAGAMENTO = :formaPagamento,
            FORNECEDORES_FOR_ID = :fornecedor
        WHERE ENT_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataCompra', $this->entrada->__get('dataCompra'));
        $stmt->bindValue(':valorTotal', $this->entrada->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->entrada->__get('dataPagamento'));
        $stmt->bindValue(':formaPagamento', $this->entrada->__get('formaPagamento'));
        $stmt->bindValue(':fornecedor', $this->entrada->__get('fornecedor'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}