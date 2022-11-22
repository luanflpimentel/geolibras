<?php 

    $pesquisadores = MySql::conectar()->prepare("SELECT * FROM `tb_site.pesquisadores`");
    $pesquisadores->execute();



?>

<div class="container text">
    <h1 class="text-center mb-3">Pesquisadores</h1>
    <?php while($dados = $pesquisadores->fetch()){ ?>
    <div class="card mb-3 bkg2-bg">
    <div class="row g-0">
        
        <div class="col-md-2">
            <img  width=500; src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $dados['imagem']; ?>" class="img-fluid rounded"  alt="<?php echo $dados['descricao_imagem'] ?>"   >
        </div>
        <div class="col-md-10">
        <div class="card-body">
            <h5 class="card-title"><?php echo $dados['nome']; ?></h5>
            <p class="text card-text"><?php echo $dados['descricao'];?></p>
            <a href="<?php echo $dados['link_lattes']; ?>" class="btn btn-primary cor-padrao">Currículo Lattes</a>
        </div>
        </div>

       
    </div>
    </div>
    <?php } ?>
</div>