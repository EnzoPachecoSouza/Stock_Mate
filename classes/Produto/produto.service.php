<?php

//SERVICE VAI EXECUTAR AS FUNÇÕES DAS AÇÕES QUE RECEBER DO CONTROLLER
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
        produtos(PRO_CODIGO, PRO_NOME, PRO_COR, PRO_MATERIAL, CATEGORIA_CAT_ID, PRO_DETALHES, PRO_PRECO_CUSTO, PRO_QUANTIDADE, PRO_MINIMO, PRO_DESCRICAO)
        VALUES (:codigo, :nome, :cor, :material, :categoria, :detalhes, :precoDeCompra, :quantidadeEmEstoque, :estoqueMinimo, :descricao)
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':codigo', $this->produto->__get('codigo'));
        $stmt->bindValue(':nome', $this->produto->__get('nome'));
        $stmt->bindValue(':cor', $this->produto->__get('cor'));
        $stmt->bindValue(':material', $this->produto->__get('material'));
        $stmt->bindValue(':categoria', $this->produto->__get('categoria'));
        $stmt->bindValue(':detalhes', $this->produto->__get('detalhes'));
        $stmt->bindValue(':precoDeCompra', $this->produto->__get('precoDeCompra'));
        $stmt->bindValue(':quantidadeEmEstoque', $this->produto->__get('quantidadeEmEstoque'));
        $stmt->bindValue(':estoqueMinimo', $this->produto->__get('estoqueMinimo'));
        $stmt->bindValue(':descricao', $this->produto->__get('descricao'));

        $stmt->execute();
    }

    public function recuperar()
    {
        //VAI MOSTRAR DE ACORDO COM A PESQUISA DA FUNÇÃO DE PESQUISAR NOME NO JS

        if (!empty($_GET['search'])) {
            $pesquisaProduto = $_GET['search'];

            $query = "
            SELECT *
            FROM PRODUTOS WHERE PRO_NOME LIKE '%$pesquisaProduto%' 
            OR PRO_COR LIKE '%$pesquisaProduto%' 
            OR PRO_MATERIAL LIKE '%$pesquisaProduto%'
            ORDER BY PRO_STATUS DESC, PRO_NOME
            ";
        } 
        
        else if (!empty($_GET['filter'])) {
            $filtrarProduto = $_GET['filter'];

            if ($filtrarProduto == 1) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_NOME ASC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 2) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_NOME DESC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 3) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_COR ASC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 4) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_COR DESC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 5) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_MATERIAL ASC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 6) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_MATERIAL DESC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 7) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 ORDER BY PRO_STATUS DESC, PRO_QUANTIDADE DESC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 8) {
                $query = "
                    SELECT *
                    FROM PRODUTOS
                    ORDER BY PRO_STATUS DESC, PRO_QUANTIDADE ASC;
                    ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 9) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 WHERE PRO_STATUS = 1
                 ORDER BY PRO_NOME ASC;
                 ";

                $filtrarProduto = 0;
            } else if ($filtrarProduto == 10) {
                $query = "
                 SELECT *
                 FROM PRODUTOS
                 WHERE PRO_STATUS = 0
                 ORDER BY PRO_NOME ASC;
                 ";

                $filtrarProduto = 0;
            }
        } 
        
        else if (!empty($_GET['catFiltro'])) {
            $filtrarCategoria = $_GET['catFiltro'];

            if (!empty($categorias)) {
                foreach ($categorias as $indice => $categoria) {
                    if ($categoria->CATEGORIA_CAT_ID == $filtrarCategoria) {
                        $query = "
                            SELECT *
                            FROM PRODUTOS
                            WHERE CAT_ID = '$filtrarCategoria';
                        ";

                        $filtrarCategoria = 0;
                    }
                }
            } else {
               echo $filtrarCategoria;
            }
        } 
        
        else {
            $query = '
            SELECT PRO.*, CATE.CAT_CATEGORIA
            FROM PRODUTOS AS PRO
            INNER JOIN CATEGORIA AS CATE ON PRO.CATEGORIA_CAT_ID = CATE.CAT_ID ORDER BY PRO_STATUS DESC, PRO_NOME;
            ';
        }

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
}
?>