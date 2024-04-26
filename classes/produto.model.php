<?php
//CLASSE DO PRODUTO
class Produto
{

    private $codigo;
    private $nome;
    private $cor;
    private $material;
    private $categoria;
    private $detalhes;
    private $precoDeCompra;
    private $quantidadeEmEstoque;
    private $estoqueMinimo;
    private $descricao;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    // private $codigo;
    // private $nome;
    // private $cor;
    // private $material;
    // private $categoria;
    // private $detalhes;
    // private $precoDeCompra;
    // private $quantidadeEmEstoque;
    // private $estoqueMinimo;
    // private $descricao;

    // public function __set($atributo, $valor){
    //     $this->$atributo = $valor;
    // }

    // public function __get($atributo){
    //     return $this->$atributo;
    // }
}