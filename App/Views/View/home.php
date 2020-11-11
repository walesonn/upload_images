<main>
    <section>
        <header>
            <h1 class="mt-1">Faça Upload de Imagens</h1>
        </header>
        <form method="post" enctype="multipart/form-data" id="form-upload" >
            <label for="imagem"><img src="Public/upload/img/foto.png" alt="icon" width="20px" height="20px"> Escolha a imagem:</label>
            <input type="file" name="imagem" id="imagem">
            <input type="submit" value="Salvar" class="btn">
        </form>
    </section>
    <div id="rsp"></div>
    <section>
        <header class="table-header">
            <h2>Tabela de Imagens salvas</h2>
        </header>
        <table>
            <thead>
                <tr>
                    <?php if(isset($imagens)):?>
                        <?php foreach($imagens as $imagem):?>
                            
                            <td>
                               <a href="/?p=imagem&n=<?=$imagem->getId()?>"><img src="<?=IMGS.$imagem->getNome() ?>" alt="Imagem" width="100%" height="100%"></a>
                            </td>
                        <?php endforeach;?>
                    <?php endif;?>
                </tr>
            </thead>
        </table>
    </section>
</main>