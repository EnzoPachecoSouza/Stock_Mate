<?php
//CLASSE DO PRODUTO

if (!class_exists('Produto')) {
    class Produto
    {
        private $codigo;
        private $nome;
        private $material;
        private $descricao;
        private $detalhes;
        private $cor;
        private $estoqueMinimo;
        private $quantidadeEmEstoque;
        private $precoDeCompra;
        private $precoDeVenda;
        private $status;
        private $categoria;

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        public function __get($atributo)
        {
            return $this->$atributo;
        }
    }
}
