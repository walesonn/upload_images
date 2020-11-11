<?php
namespace App\Models;

class Img extends Model {

    private $id;
    private $nome;
    private $data;
    private $tamanho;
    private $path;

    public function __construct( string $nome, string $data, float $tamanho, string $path, int $id = null )
    {
        $this->nome = $nome;
        $this->data = $data;
        $this->tamanho = $tamanho;
        $this->path = $path;
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTamanho()
    {
        return $this->tamanho;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getId()
    {
        return $this->id;
    }
} 