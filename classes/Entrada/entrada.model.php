<?php
if (!class_exists('ItensEntrada')) {
    class Entrada
    {
        private $dataCompra;
        private $valorTotal;
        private $dataPagamento;
        private $formaPagamento;
        private $status;
        private $fornecedor;

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