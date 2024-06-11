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
        INSERT INTO ITENS_ENTRADA (PRODUTOS_PRO_ID, ITENS_QUANTIDADE)
        VALUES (:produtoID, :produtoQuantidade)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':produtoID', $this->itensEntrada->__get('produtoID'));
        $stmt->bindValue(':produtoQuantidade', $this->itensEntrada->__get('produtoQuantidade'));

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de erros: exibe ou registra o erro
            echo 'Erro ao inserir item de entrada: ' . $e->getMessage();
        }
    }
}
