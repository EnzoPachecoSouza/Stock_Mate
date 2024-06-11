<?php
class ItensEntradaService
{
    private $conexao;
    private $itensEntrada;

    public function __construct(Conexao $conexao, ItensEntrada $itensEntrada)
    {
        $this->conexao = $conexao->conectar();
        $this->itensEntrada = $itensEntrada;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        ENTRADA(ENT_DATA_COMPRA, ENT_VALOR_TOTAL, ENT_DATA_PAGAMENTO, ENT_FORMA_PAGAMENTO, FORNECEDORES_FOR_ID)
        VALUES (:dataCompra, :valorTotal, :dataPagamento, :formaPagamento, :fornecedor)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataCompra', $this->itensEntrada->__get('dataCompra'));
        $stmt->bindValue(':valorTotal', $this->itensEntrada->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->itensEntrada->__get('dataPagamento'));
        $stmt->bindValue(':formaPagamento', $this->itensEntrada->__get('formaPagamento'));
        $stmt->bindValue(':fornecedor', $this->itensEntrada->__get('fornecedor'));

        $stmt->execute();
    }
}