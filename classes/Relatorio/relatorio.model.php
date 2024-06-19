<?php
//CLASSE DO RELATORIO

class Relatorio
{
    private $maximo;
    private $minimo;
    private $medio;
    private $desativado;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    
}