<?php

namespace App\Models;

abstract class Model{

    public function create( Img $imagem )
    {
        $sql = "INSERT INTO imagens ( nome, tamanho, endereco, data_c )";
        $sql .= "VALUES( :n, :t, :e, :d )";

        try {
            $cmd = Connection::connect()->prepare($sql);
            $cmd->bindValue( ":n", $imagem->getNome() );
            $cmd->bindValue( ":t", $imagem->getTamanho() );
            $cmd->bindValue( ":e", $imagem->getPath() );
            $cmd->bindValue( ":d", $imagem->getData() );

            return $cmd->execute();

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function all( int $id = null )
    {
        if(!empty($id))
        {
            $sql = "SELECT * FROM imagens WHERE id = :id";
            try 
            {
                $cmd = Connection::connect()->prepare($sql);
                $cmd->bindValue(":id", $id);
                $cmd->execute();
                if($cmd->rowCount() > 0)
                {
                    $imagem = $cmd->fetch(\PDO::FETCH_OBJ);

                    return new Img( $imagem->nome, $imagem->data_c, $imagem->tamanho, $imagem->endereco, $imagem->id );
                }
                return false;
            } 
            catch (\Exception $e) 
            {
                return $e->getMessage();
            }
        }

        // caso o parametro id nao seje passado 
        try 
        {
            $cmd = Connection::connect()->prepare("SELECT * FROM imagens");
            $cmd->execute();
            if($cmd->rowCount() > 0)
            {
                $imagens = $cmd->fetchAll(\PDO::FETCH_OBJ);

                foreach($imagens as $imagem)
                {
                    $lista[] = new Img( $imagem->nome,$imagem->data_c,$imagem->tamanho, $imagem->endereco,$imagem->id );
                }
                return $lista;
            }

            return [];
        } 
        catch (\Exception $th) 
        {
            return $th->getMessage();
        }

    }

    public function delete( Img $imagem )
    {
        try
        {
            $cmd = Connection::connect()->prepare("DELETE FROM imagens WHERE id = :id");
            $cmd->bindValue(":id",$imagem->getId());
            return $cmd->execute();
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    public function update( Img $imagem )
    {
        //
    }
}