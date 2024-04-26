<?php
//CLASSE DO PRODUTO
class Produto
{

    private $codigo;
    private $nome;
    private $material;
    private $categoria;
    private $descricao;
    private $cor;
    private $estoqueMinimo;
    private $quantidadeEmEstoque;
    private $precoDeCompra;
    private $detalhes;

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}