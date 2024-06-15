<?php
//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER
class ColaboradorService
{

    private $conexao;
    private $colaborador;

    public function __construct(Conexao $conexao, Colaborador $colaborador)
    {
        $this->conexao = $conexao->conectar();
        $this->colaborador = $colaborador;
    }

    public function inserir()
    {
        $query = '
        INSERT INTO
        COLABORADORES (COL_NOME, COL_EMAIL, COL_CONTATO, COL_CPF, COL_CARGO)
        VALUES (:colaborador, :email, :contato, :cpf, :cargo)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':colaborador', $this->colaborador->__get('colaborador'));
        $stmt->bindValue(':email', $this->colaborador->__get('email'));
        $stmt->bindValue(':contato', $this->colaborador->__get('contato'));
        $stmt->bindValue(':cpf', $this->colaborador->__get('cpf'));
        $stmt->bindValue(':cargo', $this->colaborador->__get('cargo'));

        $stmt->execute();
    }

    public function recuperar()
    {

        if (!empty($_GET['search'])) {
            $pesquisaColaborador = $_GET['search'];
            $query = "
        SELECT *
        FROM COLABORADORES 
        WHERE COL_NOME LIKE '%$pesquisaColaborador%' 
        OR COL_EMAIL LIKE '%$pesquisaColaborador%' 
        OR COL_CONTATO LIKE '%$pesquisaColaborador%'
        OR COL_CPF LIKE '%$pesquisaColaborador%'
        ORDER BY COL_NOME
        ";
        } else if (!empty($_GET['filter'])) {
            $filtrarColaborador = $_GET['filter'];
            $query = $this->getFilterQuery($filtrarColaborador);
        } else {
            $query = '
            SELECT *
            FROM COLABORADORES
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
                return "SELECT * FROM COLABORADORES ORDER BY COL_NOME ASC;";
            case 2:
                return "SELECT * FROM COLABORADORES ORDER BY COL_NOME DESC;";
            case 3:
                return "SELECT * FROM COLABORADORES ORDER BY COL_EMAIL ASC;";
            case 4:
                return "SELECT * FROM COLABORADORES ORDER BY COL_EMAIL DESC;";
            case 5:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CONTATO ASC;";
            case 6:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CONTATO DESC;";
            case 7:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CPF ASC;";
            case 8:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CPF DESC;";
            case 9:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CARGO DESC;";
            case 10:
                return "SELECT * FROM COLABORADORES ORDER BY COL_CARGO ASC;";
        }
    }

    public function editar($id)
    {
        $query = '
        UPDATE COLABORADORES
        SET COL_NOME = :colaborador,
            COL_EMAIL = :email,
            COL_CONTATO = :contato,
            COL_CPF = :cpf,
            COL_CARGO = :cargo
        WHERE COL_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':colaborador', $this->colaborador->__get('colaborador'));
        $stmt->bindValue(':email', $this->colaborador->__get('email'));
        $stmt->bindValue(':contato', $this->colaborador->__get('contato'));
        $stmt->bindValue(':cpf', $this->colaborador->__get('cpf'));
        $stmt->bindValue(':cargo', $this->colaborador->__get('cargo'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    public function alterarSenha($id) {
        $query = '
        UPDATE COLABORADORES
        SET COL_SENHA = :senha
        WHERE COL_ID = :id
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':senha', $this->colaborador->__get('senha'));
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
}
