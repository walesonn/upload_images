<main>
    <header>
        <h1>Imagem</h1>
    </header>
    <div id="rsp"></div>
    <section class="section-imagem">
        <?php if(isset($imagem)) :?>
                <img src="<?=IMGS.$imagem->getNome()?>" alt="imagem">
                <input type="hidden" name="nome_imagem" id="nome_imagem" value="<?=$imagem->getNome()?>">
                <input type="hidden" name="id" id="id" value="<?=$imagem->getId()?>">

        <?php endif;?>

        <div class="btn-apagar flex space-between">
            <div class="btn-voltar">
                <a href="/">&#10094;</a>
            </div>
            <a href="#" onclick="girarImagem('e')">&#10094;&nbsp;Girar para esquerda</a>
            <a href="#" onclick="girarImagem('d')">Girar para direita&nbsp;&#10095;</a>
            <i class="fa fa-trash-o" aria-hidden="true" onclick="apagar(<?=$imagem->getId()?>)"></i>
        </div>
        
    </section>
    
</main>