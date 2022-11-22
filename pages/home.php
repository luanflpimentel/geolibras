<?php

    $regioes = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` ORDER BY `nome_regiao` ASC");
    $regioes->execute();
    
?>

<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-mdbetween py-3 mb-3">
    <iframe width="750" height="422" src="https://www.youtube.com/embed/xAVoWqrsllk"
    title="YouTube video player" frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen></iframe>
</div>

<div class="text container mb-3">
    <div class="row">
        <div class=" col-sm-12 text-center my-3">
            <p class="fs-1">Regiões</p>
        </div>
    </div>
    
    
    <div class="row">
    <?php
        while($dados = $regioes->fetch()) {

    ?>
        <div class="col-sm-12 col-md-6">
       
            <div class="text card my-3 bkg2-bg">
                <img class="img-regioes" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $dados['imagem']; ?>" class="card-img-top" alt="<?php echo $dados['descricao_imagem']?>">
                <div class="card-body">
                    <p class="card-title fs-5"><?php echo $dados['nome_regiao']?></p>
                    <p class="card-text"><?php echo strip_tags($dados['descricao'])?></p>
                    <a href="<?php INCLUDE_PATH ?>regioes/<?php echo $dados['slug']?>" class="btn btn-primary cor-padrao">Estados do <?php echo $dados['nome_regiao']?></a>
                </div>
            </div>
        </div>
    

    <?php } ?>
    </div>
</div>
