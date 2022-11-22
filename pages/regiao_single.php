<?php
	$url = explode('/',$_GET['url']);
	
    if(!isset($url[2])){
	$verifica_regiao = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` WHERE slug = ?");
	$verifica_regiao->execute(array($url[1]));
	if($verifica_regiao->rowCount() == 0){
        
		Painel::redirect(INCLUDE_PATH.'regioes');
	}
	$regiao_info = $verifica_regiao->fetch();
    

	$estado = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados` WHERE regiao_id = ?");
	$estado->execute(array($regiao_info['id']));
	

?>

<div class="container mb-3">
    <div class="row">
        <div class="text col-sm-12 text-center my-3">
            <h1>Região <?php echo $regiao_info['nome_regiao'];?></h1>
            <h3 class="text-muted" >Estados</h3>
        </div>
    </div>

    <div class="row">
    <div class="list-group">
    <?php
			$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.estados` WHERE regiao_id = ?");
			$verifica->execute(array($regiao_info['id']));
			if($verifica->rowCount() >= 1){
		
		?>
            <?php 
                while($dados = $estado->fetch()) {
            ?>

                <a href="<?php echo INCLUDE_PATH ?>regioes/<?php echo $regiao_info['slug']; ?>/<?php echo $dados['slug']?>" class="list-group-item list-group-item-action bkg2-bg text" >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $dados['nome_estado']?></h5>
                        <small><?php echo $dados['qtde_municipios']?> Municípios</small>
                    </div>
                    <p class="mb-1">
                        <?php echo $dados['descricao']?>
                    </p>
                    <small class="text-muted">Capital: <?php echo $dados['capital']?></small>
                </a>
                
            <?php } ?>

            <?php } else {
					Painel::alert('info','Ainda não há nenhum estado cadastrado nessa região');
				}?>
        </div>
    </div>
</div>

<?php }else{ 
	
    include('estado_single.php');
}
?>
