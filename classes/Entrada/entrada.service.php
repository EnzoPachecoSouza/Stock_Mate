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
        ENTRADA(ENT_DATA_COMPRA, ENT_VALOR_TOTAL, ENT_DATA_PAGAMENTO, ENT_FORMA_PAGAMENTO)
        VALUES (:dataCompra, :valorTotal, :dataPagamento, :formaPagamento)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataCompra', $this->entrada->__get('dataCompra'));
        $stmt->bindValue(':valorTotal', $this->entrada->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->entrada->__get('dataPagamento'));
        // $stmt->bindValue(':fornecedor', $this->entrada->__get('fornecedor'));
        $stmt->bindValue(':formaPagamento', $this->entrada->__get('formaPagamento'));

        $stmt->execute();
    }

    public function recuperar()
    {
        $query = '
        SELECT *
        FROM ENTRADA
        ';

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
            ENT_FORMA_PAGAMENTO = :formaPagamento
        WHERE ENT_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataCompra', $this->entrada->__get('dataCompra'));
        $stmt->bindValue(':valorTotal', $this->entrada->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->entrada->__get('dataPagamento'));
        // $stmt->bindValue(':fornecedor', $this->entrada->__get('fornecedor'));
        $stmt->bindValue(':formaPagamento', $this->entrada->__get('formaPagamento'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}