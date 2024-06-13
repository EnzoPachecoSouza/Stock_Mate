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
        INSERT INTO ITENS_ENTRADA (ENTRADA_ENT_ID, PRODUTOS_PRO_ID, ITENS_QUANTIDADE)
        VALUES (:entradaID, :produtoID, :produtoQuantidade)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':entradaID', $this->itensEntrada->__get('entradaID'));
        $stmt->bindValue(':produtoID', $this->itensEntrada->__get('produtoID'));
        $stmt->bindValue(':produtoQuantidade', $this->itensEntrada->__get('produtoQuantidade'));

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao inserir item de entrada: ' . $e->getMessage();
        }
    }
}
