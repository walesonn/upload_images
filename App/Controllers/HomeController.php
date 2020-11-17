<?php

namespace App\Controllers;

use App\Lib\File;
use App\Models\Img;

class HomeController extends Controller{

    public function index()
    {
        $imagens = Img::all();
        return $this->view( "home",['imagens'=>$imagens] );
    }

    public function upload()
    {
        if(isset($_FILES))
        {   
            $data = date("Y-m-d");
            $name = $_FILES['imagem']['name'];
            $size = $_FILES['imagem']['size'];
            $type =  $_FILES['imagem']['type'];
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $file = new File($name, $size,$type, $tmp_name);

            if($file->create($file))
            {
                $img = new Img($file->getName(), $data, $file->getSize(), $file->getPath());
                return $img->create($img)? $this->index() : "err2";
            }
            //"Erro ao fazer upload de arquivo"
            echo "err1";
            return;
        }
    }

    public function verImagem()
    {
        if(isset($_GET['n']) && is_numeric($_GET['n']) && Img::all($_GET['n']))
        {
            $imagem = Img::all($_GET['n']);
            return $this->view("imagem",['imagem'=>$imagem]);
        }

        header("Location: /");
        
    }

    public function delete()
    {
        if(isset($_GET['n']))
        {
            $imagem = Img::all($_GET['n']);

            if(File::delete($imagem))
            {
                if($imagem->delete($imagem))
                {
                    return $this->index();
                }
                echo "d2";
                return;
            }
            echo "d1";
            return;
        }
        else
        {
            echo "Esta imagem ja foi apagada";
        }
    }

    public function girarImagem()
    {
        if(isset($_GET))
        {
            $imgOriginal = IMGS . $_GET['nome_imagem'];
            if(file_exists($imgOriginal))
            {
                
                $imgOriginal = imagecreatefromjpeg($imgOriginal);
                $imgeRotate = ( $_GET['direcao'] == 'e')? imagerotate($imgOriginal,90,0): imagerotate($imgOriginal,-90,0);
                if(imagejpeg($imgeRotate,IMGS . $_GET['nome_imagem']))
                {
                    imagedestroy($imgeRotate);
                    imagedestroy($imgOriginal);
                    return $this->index();
                    
                }
                die("Imagem não existe no servidor");
            }
            die("Imagem não existe");
        }
    }
}