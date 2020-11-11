<main>
    <header>
        <h1>Imagem</h1>
    </header>
    <div id="rsp"></div>
    <section class="section-imagem">
        <?php if(isset($imagem)) :?>
                <img src="<?=IMGS.$imagem->getNome()?>" alt="imagem">
        <?php endif;?>
        <ul>
            <li>
                <h2>Nome:<?=$imagem->getNome()?></h2>
            </li>
            <li>
                <h2>Tamanho:<?=$imagem->getTamanho()."KB"?></h2>
            </li>
            <li>
                <h2>Data_upload:
                    <?php
                        $data = explode("-",$imagem->getData());
                        echo $data[2] ."/". $data[1] . "/". $data[0];
                    ?>
                </h2>
            </li>
        </ul>

        <div class="btn-apagar">
            <i class="fa fa-trash-o" aria-hidden="true" onclick="apagar(<?=$imagem->getId()?>)"></i>
        </div>
    </section>
    <a href="/">Voltar</a>
</main>