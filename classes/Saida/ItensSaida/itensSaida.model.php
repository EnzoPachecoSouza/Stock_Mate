<?php

class ItensSaida
{
    private $saidaID;
    private $produtoID;
    private $produtoQuantidade;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}