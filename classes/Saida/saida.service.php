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
        $query = '';

        if (!empty($_GET['search'])) {
            $pesquisaProduto = $_GET['search'];
            $query = "
            SELECT SAI.*, CLIE.CLI_NOME
            FROM SAIDA AS SAI
            INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
            WHERE CLIE.CLI_NOME LIKE :search 
            OR SAI.SAIDA_FORMA_PAGAMENTO LIKE :search
            OR SAI.SAIDA_DATA_VENDA LIKE :search
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':search', "%$pesquisaProduto%");
        } elseif (!empty($_GET['catPag'])) {
            $filtrarFormaPagamento = $_GET['catPag'];
            $query = "
            SELECT SAI.*, CLIE.CLI_NOME
            FROM SAIDA AS SAI
            INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
            WHERE SAIDA_FORMA_PAGAMENTO = :catPag
            ORDER BY SAIDA_DATA_VENDA ASC;
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':catPag', $filtrarFormaPagamento);
        } elseif (!empty($_GET['filter'])) {
            $filtrarSaida = $_GET['filter'];
            $query = $this->getFilterQuery($filtrarSaida);

            $stmt = $this->conexao->prepare($query);
        } else {
            $query = '
            SELECT SAI.*, CLIE.CLI_NOME
            FROM SAIDA AS SAI
            INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
            ORDER BY SAIDA_ID
            ';

            $stmt = $this->conexao->prepare($query);
        }

        if ($query == '') {
            throw new Exception('Query não pode estar vazia');
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function getFilterQuery($filter)
    {
        switch ($filter) {
            case 1:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY CLI_NOME ASC";
            case 2:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY CLI_NOME DESC";
            case 3:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_DATA_VENDA ASC";
            case 4:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_DATA_VENDA DESC";
            case 5:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_DATA_PAGAMENTO ASC";
            case 6:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_DATA_PAGAMENTO DESC";
            case 7:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_VALOR_TOTAL ASC";
            case 8:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_VALOR_TOTAL DESC";
            case 9:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID
                        ORDER BY SAIDA_ID";
            default:
                return "SELECT SAI.*, CLIE.CLI_NOME FROM SAIDA AS SAI 
                        INNER JOIN CLIENTE AS CLIE ON SAI.CLIENTE_CLI_ID = CLIE.CLI_ID";
        }
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
?>
