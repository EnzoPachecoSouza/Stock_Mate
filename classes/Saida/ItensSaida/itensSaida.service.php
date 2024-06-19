<?php

if (!class_exists('ItensSaidaService')) {

    class ItensSaidaService
    {
        private $conexao;
        private $itensSaida;

        public function __construct(Conexao $conexao, ItensSaida $itensSaida)
        {
            $this->conexao = $conexao->conectar();
            $this->itensSaida = $itensSaida;
        }

        public function inserir()
        {
            $query = '
        INSERT INTO ITENS_SAIDA (SAIDA_SAIDA_ID, PRODUTOS_PRO_ID, ITENS_QUANTIDADE)
        VALUES (:saidaID, :produtoID, :produtoQuantidade)
        ';

            $stmt = $this->conexao->prepare($query);

            $stmt->bindValue(':saidaID', $this->itensSaida->__get('saidaID'));
            $stmt->bindValue(':produtoID', $this->itensSaida->__get('produtoID'));
            $stmt->bindValue(':produtoQuantidade', $this->itensSaida->__get('produtoQuantidade'));

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Erro ao inserir item de saida: ' . $e->getMessage();
            }
        }

        public function recuperar()
        {

            $query = '
            SELECT *
            FROM ITENS_ENTRADA;
            ';

            $stmt = $this->conexao->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
}
