<?php
	$url = explode('/',$_GET['url']);
	if(!isset($url[1]))
	{
        $regioes = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` ORDER BY `nome_regiao` ASC");
        $regioes->execute();
?>

<div class="container text">

    <div class="row">
        <div class=" col-sm-12 text-center my-3">
            <h1>Regiões</h1>
        </div>
    </div>
    
    <div class=" row">
        <?php
            while($dados = $regioes->fetch()) {

        ?>
            <div class=" col-sm-12 col-md-6">
        
                <div class="bkg2-bg card my-3">
                    <img  style="height:300px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $dados['imagem']; ?>" class="card-img-top img-fluid" alt="<?php echo $dados['descricao_imagem']?>">
                    <div class=" card-body">
                        <h5 class=" card-title"><?php echo $dados['nome_regiao']?></h5>
                        <p class="card-text">
                            <?php echo $dados['descricao']?>
                        </p>
                        <a href="<?php INCLUDE_PATH ?>regioes/<?php echo $dados['slug']?>" class="btn btn-primary cor-padrao">Estados do <?php echo $dados['nome_regiao']?></a>
                    </div>
                </div>
            </div>
        

        <?php } ?>
    </div>
</div>

<?php }else{ 
	include('regiao_single.php');
}
?>