<?php
//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER
class ClienteService
{

    private $conexao;
    private $cliente;

    public function __construct(Conexao $conexao, Cliente $cliente)
    {
        $this->conexao = $conexao->conectar();
        $this->cliente = $cliente;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        CLIENTE (CLI_NOME, CLI_EMAIL, CLI_CONTATO, CLI_CPF)
        VALUES (:nome, :email, :contato, :cpf)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':nome', $this->cliente->__get('nome'));
        $stmt->bindValue(':email', $this->cliente->__get('email'));
        $stmt->bindValue(':contato', $this->cliente->__get('contato'));
        $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));

        $stmt->execute();
    }

    public function recuperar()
    {

        if (!empty($_GET['search'])) {
            $pesquisaCliente = $_GET['search'];
            $query = "
        SELECT *
        FROM CLIENTE 
        WHERE CLI_NOME LIKE '%$pesquisaCliente%' 
        OR CLI_EMAIL LIKE '%$pesquisaCliente%' 
        OR CLI_CONTATO LIKE '%$pesquisaCliente%'
        OR CLI_CPF LIKE '%$pesquisaCliente%'
        ORDER BY CLI_NOME
        ";
        }else if (!empty($_GET['filter'])) {
            $filtrarProduto = $_GET['filter'];
            $query = $this->getFilterQuery($filtrarProduto);
        } else {
            $query = '
            SELECT *
            FROM CLIENTE
        ';
        }

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function getFilterQuery($filter)
    {
        switch ($filter) {
            case 1:
                return "SELECT * FROM CLIENTE ORDER BY  CLI_NOME ASC;";
            case 2:
                return "SELECT * FROM CLIENTE ORDER BY CLI_NOME DESC;";
            case 3:
                return "SELECT * FROM CLIENTE ORDER BY CLI_EMAIL ASC;";
            case 4:
                return "SELECT * FROM CLIENTE ORDER BY CLI_EMAIL DESC;";
            case 5:
                return "SELECT * FROM CLIENTE ORDER BY CLI_CONTATO ASC;";
            case 6:
                return "SELECT * FROM CLIENTE ORDER BY CLI_CONTATO DESC;";
            case 7:
                return "SELECT * FROM CLIENTE ORDER BY CLI_CPF ASC;";
            case 8:
                return "SELECT * FROM CLIENTE ORDER BY CLI_CPF DESC;";
        }
    }

    public function editar($id)
    {
        $query = '
        UPDATE CLIENTE
        SET CLI_NOME = :nome,
            CLI_EMAIL = :email,
            CLI_CONTATO = :contato,
            CLI_CPF = :cpf
        WHERE CLI_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':nome', $this->cliente->__get('nome'));
        $stmt->bindValue(':email', $this->cliente->__get('email'));
        $stmt->bindValue(':contato', $this->cliente->__get('contato'));
        $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}
?>