<main>
    <header>
        <h1>Imagem</h1>
    </header>
    <div id="rsp"></div>
    <section class="section-imagem">
        <?php if(isset($imagem)) :?>
                <img src="<?=IMGS.$imagem->getNome()?>" alt="imagem">
        <?php endif;?>

        <div class="btn-apagar flex space-between">
            <div class="btn-voltar">
                <a href="/">&#10094;</a>
            </div>
            <i class="fa fa-trash-o" aria-hidden="true" onclick="apagar(<?=$imagem->getId()?>)"></i>
        </div>
        
    </section>
    
</main>