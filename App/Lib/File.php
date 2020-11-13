<?php
namespace App\Lib;

use Exception;
use App\Models\Img;

class File {

    private $nome;
    private $size;
    private $type;
    private $tmp_name;
    private $path = UPLOAD_PATH;

    public function __construct( string $nome, float $size, string $type, string $tmp_name )
    {
        $this->setNome($nome);
        $this->setTmpName($tmp_name);

        if(!$this->setSize($size))
        {
            die("size");
        }

        if(!$this->setType($type))
        {
            die("type");
        }
    }

    public function create(File $file)
    {
        
        if( move_uploaded_file( $file->getTmpName(), $file->getPath() . $file->getName() ) )
        {
            return true;
        }
        die("Erro ao fazer upload de imagem");
    }

    public function getName()
    {
        return $this->nome;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getTmpName()
    {
        return $this->tmp_name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getType()
    {
        return $this->type;
    }

    private function setNome( string $nome )
    {
        $this->nome = md5(rand(1, 100000)) . $nome;
    }

    private function  setType( string $type )
    {
        if( $type === "image/png" || $type === "image/jpeg" || $type === "image/gif")
        {
            $this->type = $type;
            return true;
        }
        return false;
    }

    private function setTmpName( string $tmp_name )
    {
        $this->tmp_name = $tmp_name;
    }

    private function setSize( float $size )
    {
        if( ($size / 1024 ) < 2048 )
        {
            $this->size = number_format(($size / 1024),2);

            return true;
        }
        return false;
    }

    public static function delete(Img $file)
    {
        if(unlink($file->getPath().$file->getNome()))
        {
            return true;
        }
        return false;
    }

}