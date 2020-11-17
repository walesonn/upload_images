<?php
namespace App\Lib;

use Exception;
use App\Models\Img;

class File {

    private $name;
    private $size;
    private $type;
    private $tmp_name;
    private $path = UPLOAD_PATH;

    public function __construct( string $name, float $size, string $type, string $tmp_name )
    {
        $this->setName($name);
        $this->setTmpName($tmp_name);
        $this->size = $this->setSize($size);
        $this->type = $this->validType($type)? $type : die("type");
    }

    public function create(File $file)
    {
        
        if(move_uploaded_file($file->getTmpName(), $file->getPath() . $file->getName()))
        {
            $image = $file->getPath() . $file->getName();
            if(file_exists($image))
            {
                $image = imagecreatefromjpeg($image);
                $width = imagesx($image);
                $height = imagesy($image);
                $width_new = $width * 0.5;
                $height_new = $height * 0.5;
                
                $imgNova = imagecreatetruecolor( $width_new,$height_new );
                // copia e redimensiona a imagem
                
                if(imagecopyresampled($imgNova,$image,0,0,0,0,$width_new,$height_new,$width,$height) && unlink($file->getPath() . $file->getName()))
                {
                    imagejpeg($imgNova,$file->getPath() . $file->getName(),75);
                    imagedestroy($imgNova);
                    imagedestroy($image);
                    return true;
                }
                return false;
            }
            die("Arquivo não existe");
        }
        die("Impossivel fazer upload error interno");
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return intval($this->size);
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

    private function setName( string $nome )
    {
        $this->name = md5(rand(1,1000)). $nome;
    }

    private function validType(string $type)
    {
        if($type == "image/jpeg")
        {
            return true;
        }
        return false;
    }


    private function setTmpName( string $tmp_name )
    {
        $this->tmp_name = $tmp_name;
    }

    private function setSize(float $size)
    {
       return number_format(($size / 1024),2);
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