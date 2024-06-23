<?php
require_once "../../classes/Categoria/categoria.controller.php";
require_once "../../classes/Categoria/categoria.model.php";
require_once "../../classes/Categoria/categoria.service.php";
//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER

if (!class_exists('ProdutoService')) {
    class ProdutoService
    {
        private $conexao;
        private $produto;

        public function __construct(Conexao $conexao, Produto $produto)
        {
            $this->conexao = $conexao->conectar();
            $this->produto = $produto;
        }

        public function inserir()
        {
            $query = '
        INSERT INTO
        produtos(PRO_CODIGO, PRO_NOME, PRO_COR, PRO_MATERIAL, CATEGORIA_CAT_ID, PRO_DETALHES, PRO_PRECO_CUSTO, PRO_PRECO_VENDA, PRO_QUANTIDADE, PRO_MINIMO, PRO_DESCRICAO)
        VALUES (:codigo, :nome, :cor, :material, :categoria, :detalhes, :precoDeCompra, :precoDeVenda, :quantidadeEmEstoque, :estoqueMinimo, :descricao)
        ';

            $stmt = $this->conexao->prepare($query);

            $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
            $stmt->bindValue(':nome', $this->produto->__get('nome'));
            $stmt->bindValue(':cor', $this->produto->__get('cor'));
            $stmt->bindValue(':material', $this->produto->__get('material'));
            $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
            $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));
            $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
            $stmt->bindValue(':precoDeVenda', $this->produto->__get('precoDeVenda'));
            $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
            $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
            $stmt->bindValue(':descricao', $this->produto->__get('descricao'));

            $stmt->execute();
        }

        public function recuperar()
        {
            if (!empty($_GET['search'])) {
                $pesquisaProduto = $_GET['search'];
                $query = "
        SELECT *
        FROM PRODUTOS 
        WHERE PRO_NOME LIKE '%$pesquisaProduto%' 
        OR PRO_COR LIKE '%$pesquisaProduto%' 
        OR PRO_MATERIAL LIKE '%$pesquisaProduto%'
        OR PRO_DETALHES LIKE '%$pesquisaProduto%'
        ORDER BY PRO_STATUS DESC, PRO_NOME
        ";

            } elseif (!empty($_GET['filter'])) {
                $filtrarProduto = $_GET['filter'];
                $query = $this->getFilterQuery($filtrarProduto);

            } elseif (!empty($_GET['catFiltro'])) {
                $filtrarCategoria = $_GET['catFiltro'];

                $query = "
                SELECT *
                FROM PRODUTOS
                WHERE CATEGORIA_CAT_ID = '$filtrarCategoria'
                AND PRO_STATUS = 1
                ORDER BY PRO_STATUS DESC, PRO_NOME;
                ";

            } elseif (!empty($_GET['filCor'])) {
                $filtrarCores = $_GET['filCor'];

                if ($filtrarCores == "vermelho") {
                    $query = "
                SELECT *
                FROM PRODUTOS
                WHERE PRO_QUANTIDADE <= PRO_MINIMO AND 
                PRO_STATUS = 1
                ORDER BY PRO_STATUS DESC, PRO_NOME;
                ";
                } else if ($filtrarCores == "amarelo") {
                    $query = "
                SELECT *
                FROM PRODUTOS
                WHERE PRO_QUANTIDADE > PRO_MINIMO AND 
                PRO_QUANTIDADE <= PRO_MINIMO * 2 AND 
                PRO_STATUS = 1
                ORDER BY PRO_STATUS DESC, PRO_NOME;
                ";
                } else if ($filtrarCores == "verde") {
                    $query = "
                SELECT *
                FROM PRODUTOS
                WHERE PRO_QUANTIDADE > PRO_MINIMO * 2 AND 
                PRO_STATUS = 1
                ORDER BY PRO_STATUS DESC, PRO_NOME;
                ";
                } else {
                    $query = '
        SELECT PRO.*, CATE.CAT_CATEGORIA
        FROM PRODUTOS AS PRO
        INNER JOIN CATEGORIA AS CATE ON PRO.CATEGORIA_CAT_ID = CATE.CAT_ID 
        ORDER BY PRO_STATUS DESC, PRO_ID ASC;
        ';
                }

            } else {
                $query = '
        SELECT PRO.*, CATE.CAT_CATEGORIA
        FROM PRODUTOS AS PRO
        INNER JOIN CATEGORIA AS CATE ON PRO.CATEGORIA_CAT_ID = CATE.CAT_ID 
        ORDER BY PRO_STATUS DESC, PRO_ID ASC;
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
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_NOME ASC;";
                case 2:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_NOME DESC;";
                case 3:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_COR ASC;";
                case 4:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_COR DESC;";
                case 5:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_MATERIAL ASC;";
                case 6:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_MATERIAL DESC;";
                case 7:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_PRECO_VENDA ASC;";
                case 8:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_PRECO_VENDA DESC;";
                case 9:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_QUANTIDADE DESC;";
                case 10:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_QUANTIDADE ASC;";
                case 11:
                    return "SELECT * FROM PRODUTOS WHERE PRO_STATUS = 1 ORDER BY PRO_NOME ASC;";
                case 12:
                    return "SELECT * FROM PRODUTOS WHERE PRO_STATUS = 0 ORDER BY PRO_NOME ASC;";
                case 13:
                    return "SELECT * FROM PRODUTOS ORDER BY PRO_STATUS DESC, PRO_ID ASC;";
            }
        }


        public function editar($id)
        {
            $query = '
        UPDATE PRODUTOS
        SET PRO_CODIGO = :codigo,
            PRO_NOME = :nome,
            PRO_COR = :cor,
            PRO_MATERIAL = :material,
            CATEGORIA_CAT_ID = :categoria,
            PRO_DETALHES = :detalhes,
            PRO_PRECO_CUSTO = :precoDeCompra,
            PRO_PRECO_VENDA = :precoDeVenda,
            PRO_QUANTIDADE = :quantidadeEmEstoque,
            PRO_MINIMO = :estoqueMinimo,
            PRO_DESCRICAO = :descricao
        WHERE PRO_ID = :id
        ';

            $stmt = $this->conexao->prepare($query);

            $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
            $stmt->bindValue(':nome', $this->produto->__get('nome'));
            $stmt->bindValue(':cor', $this->produto->__get('cor'));
            $stmt->bindValue(':material', $this->produto->__get('material'));
            $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
            $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));
            $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
            $stmt->bindValue(':precoDeVenda', $this->produto->__get('precoDeVenda'));
            $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
            $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
            $stmt->bindValue(':descricao', $this->produto->__get('descricao'));
            $stmt->bindValue(':id', $id);

            $stmt->execute();
        }

        public function desativar($id)
        {
            $query = '
        UPDATE PRODUTOS
        SET PRO_STATUS = :status
        WHERE PRO_ID = :id
        ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':status', 0);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function ativar($id)
        {
            $query = '
            UPDATE PRODUTOS
            SET PRO_STATUS = :status
            WHERE PRO_ID = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':status', 1);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function atualizarEntrada($id, $quantidade)
        {
            $query = '
            UPDATE PRODUTOS
            SET PRO_QUANTIDADE = PRO_QUANTIDADE + :quantidade
            WHERE PRO_ID = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function atualizarSaida($id, $quantidade)
        {
            $query = '
            UPDATE PRODUTOS
            SET PRO_QUANTIDADE = PRO_QUANTIDADE - :quantidade
            WHERE PRO_ID = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }
    }
}
