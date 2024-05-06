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