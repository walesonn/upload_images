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
            $file = new File($_FILES['imagem']['name'], $_FILES['imagem']['size'], $_FILES['imagem']['type'], $_FILES['imagem']['tmp_name']);

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
        if(isset($_GET['n']) && is_numeric($_GET['n']))
        {
            $imagem = Img::all($_GET['n']);
        }

        return $this->view("imagem",['imagem'=>$imagem]);
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
    }
}