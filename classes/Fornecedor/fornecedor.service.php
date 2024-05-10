<?php
//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER
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
        $query = '
        SELECT *
        FROM FORNECEDORES
        ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}