<?php
class FornecedorService
{
    private $conexao;
    private $fornecedor;

    public function __construct(Conexao $conexao, Fornecedor $fornecedor)
    {
        $this->conexao = $conexao->conectar();
        $this->fornecedor = $fornecedor;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        FORNECEDORES (FOR_NOME, FOR_EMAIL, FOR_CONTATO, FOR_CNPJ)
        VALUES (:fornecedor, :email, :contato, :cnpj)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':fornecedor', $this->fornecedor->__get('fornecedor'));
        $stmt->bindValue(':email', $this->fornecedor->__get('email'));
        $stmt->bindValue(':contato', $this->fornecedor->__get('contato'));
        $stmt->bindValue(':cnpj', $this->fornecedor->__get('cnpj'));

        $stmt->execute();
    }

    public function recuperar()
    {
        $query = '';

        if (!empty($_GET['search'])) {
            $pesquisaFornecedor = $_GET['search'];
            $query = "
            SELECT *
            FROM FORNECEDORES 
            WHERE FOR_NOME LIKE :search 
            OR FOR_EMAIL LIKE :search 
            OR FOR_CONTATO LIKE :search
            OR FOR_CNPJ LIKE :search
            ORDER BY FOR_NOME
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':search', "%$pesquisaFornecedor%");
        } elseif (!empty($_GET['filter'])) {
            $filtrarFornecedor = $_GET['filter'];
            $query = $this->getFilterQuery($filtrarFornecedor);

            $stmt = $this->conexao->prepare($query);
        } else {
            $query = '
            SELECT *
            FROM FORNECEDORES
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
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_NOME ASC;";
            case 2:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_NOME DESC;";
            case 3:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_EMAIL ASC;";
            case 4:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_EMAIL DESC;";
            case 5:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_CONTATO ASC;";
            case 6:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_CONTATO DESC;";
            case 7:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_CNPJ ASC;";
            case 8:
                return "SELECT * FROM FORNECEDORES ORDER BY FOR_CNPJ DESC;";
            default:
                return "SELECT * FROM FORNECEDORES";
        }
    }

    public function editar($id)
    {
        $query = '
        UPDATE FORNECEDORES
        SET FOR_NOME = :fornecedor,
            FOR_EMAIL = :email,
            FOR_CONTATO = :contato,
            FOR_CNPJ = :cnpj
        WHERE FOR_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':fornecedor', $this->fornecedor->__get('fornecedor'));
        $stmt->bindValue(':email', $this->fornecedor->__get('email'));
        $stmt->bindValue(':contato', $this->fornecedor->__get('contato'));
        $stmt->bindValue(':cnpj', $this->fornecedor->__get('cnpj'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}
