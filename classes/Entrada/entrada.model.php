<?php

class Entrada
{
    // private $fornecedor;
    private $dataCompra;
    private $valorTotal;
    private $dataPagamento;
    private $formaPagamento;
    private $status;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}