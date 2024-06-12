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

    public function getID()
    {
        $query = '
        SELECT ENT_ID FROM ENTRADA
        ORDER BY ENT_ID DESC
        LIMIT 1
        ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->ENT_ID : null;
    }


    public function recuperar()
    {
        $query = '';

        if (!empty($_GET['search'])) {
            $pesquisaProduto = $_GET['search'];
            $query = "
            SELECT ENT.*, FORN.FOR_NOME
            FROM ENTRADA AS ENT
            INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
            WHERE FORN.FOR_NOME LIKE :search 
            OR ENT.ENT_FORMA_PAGAMENTO LIKE :search
            OR ENT.ENT_DATA_COMPRA LIKE :search
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':search', "%$pesquisaProduto%");
        } elseif (!empty($_GET['catPag'])) {
            $filtrarFormaPagamento = $_GET['catPag'];
            $query = "
            SELECT ENT.*, FORN.FOR_NOME
            FROM ENTRADA AS ENT
            INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
            WHERE ENT_FORMA_PAGAMENTO = :catPag
            ORDER BY ENT_DATA_COMPRA ASC;
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':catPag', $filtrarFormaPagamento);
        } elseif (!empty($_GET['filter'])) {
            $filtrarEntrada = $_GET['filter'];
            $query = $this->getFilterQuery($filtrarEntrada);

            $stmt = $this->conexao->prepare($query);
        } else {
            $query = '
            SELECT ENT.*, FORN.FOR_NOME
            FROM ENTRADA AS ENT
            INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
            ORDER BY ENT_ID
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
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY FOR_NOME ASC";
            case 2:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY FOR_NOME DESC";
            case 3:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_DATA_COMPRA ASC";
            case 4:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_DATA_COMPRA DESC";
            case 5:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_DATA_PAGAMENTO ASC";
            case 6:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_DATA_PAGAMENTO DESC";
            case 7:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_VALOR_TOTAL ASC";
            case 8:
                return "SELECT ENT.*, FORN.FOR_NOME FROM ENTRADA AS ENT 
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_VALOR_TOTAL DESC";
            case 9:
                return "SELECT ENT.*, FORN.FOR_NOME
                FROM ENTRADA AS ENT
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID
                ORDER BY ENT_ID";
            default:
                return "SELECT ENT.*, FORN.FOR_NOME
                FROM ENTRADA AS ENT
                INNER JOIN FORNECEDORES AS FORN ON ENT.FORNECEDORES_FOR_ID = FORN.FOR_ID";
        }
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
