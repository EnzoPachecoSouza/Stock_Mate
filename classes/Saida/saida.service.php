<?php

class SaidaService
{

    private $conexao;
    private $saida;

    public function __construct(Conexao $conexao, Saida $saida)
    {
        $this->conexao = $conexao->conectar();
        $this->saida = $saida;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        SAIDA(SAIDA_DATA_VENDA, SAIDA_VALOR_TOTAL, SAIDA_DATA_PAGAMENTO, SAIDA_FORMA_PAGAMENTO, CLIENTE_CLI_ID)
        VALUES (:dataVenda, :valorTotal, :dataPagamento, :formaPagamento, :cliente)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataVenda', $this->saida->__get('dataVenda'));
        $stmt->bindValue(':valorTotal', $this->saida->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->saida->__get('dataPagamento'));
        $stmt->bindValue(':formaPagamento', $this->saida->__get('formaPagamento'));
        $stmt->bindValue(':cliente', $this->saida->__get('cliente'));

        $stmt->execute();
    }

    public function recuperar()
    {
        //VAI MOSTRAR DE ACORDO COM A PESQUISA DA FUNÇÃO DE PESQUISAR NOME NO JS
        if (!empty($_GET['search'])) {
            $pesquisaProduto = $_GET['search'];

            $query = "
            SELECT SAI.*, CLIE.CLI_NOME
            FROM SAIDA AS SAI
            INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
            WHERE CLIE.CLI_NOME LIKE '%$pesquisaProduto%' OR SAI.SAIDA_FORMA_PAGAMENTO LIKE '%$pesquisaProduto%'
            ";
        } else {
            $query = '
            SELECT SAI.*, CLIE.CLI_NOME
            FROM SAIDA AS SAI
            INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID;
            ';
        }       

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function editar($id)
    {
        $query = '
        UPDATE SAIDA
        SET SAIDA_DATA_VENDA = :dataVenda,
        SAIDA_VALOR_TOTAL = :valorTotal,
        SAIDA_DATA_PAGAMENTO = :dataPagamento,
        SAIDA_FORMA_PAGAMENTO = :formaPagamento,
        CLIENTE_CLI_ID = :cliente
        WHERE SAIDA_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':dataVenda', $this->saida->__get('dataVenda'));
        $stmt->bindValue(':valorTotal', $this->saida->__get('valorTotal'));
        $stmt->bindValue(':dataPagamento', $this->saida->__get('dataPagamento'));
        $stmt->bindValue(':formaPagamento', $this->saida->__get('formaPagamento'));
        $stmt->bindValue(':cliente', $this->saida->__get('cliente'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

}