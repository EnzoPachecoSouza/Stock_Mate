<?php
//CLASSE DO PRODUTO
class Fornecedor
{

    private $nome;
    private $status;
    private $email;
    private $contato;
    private $cpf;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}