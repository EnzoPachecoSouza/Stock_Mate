<?php
//CLASSE DE CLIENTE
class Colaborador
{

    private $nome;
    private $status;
    private $email;
    private $contato;
    private $cpf;
    private $senha;
    private $cargo;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}