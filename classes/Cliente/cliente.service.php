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

    public function recuperar()
    {
        $query = '
        SELECT *
        FROM CLIENTE
        ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}