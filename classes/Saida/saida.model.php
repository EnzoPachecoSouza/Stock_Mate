<?php

class Saida
{
    private $dataVenda;
    private $valorTotal;
    private $dataPagamento;
    private $formaPagamento;
    private $status;
    private $cliente;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}