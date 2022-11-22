<?php
	$url = explode('/',$_GET['url']);
	
	$verifica_regiao = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` WHERE slug = ?");
	$verifica_regiao->execute(array($url[1]));
	if($verifica_regiao->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'regioes');
	}
	$regiao_info = $verifica_regiao->fetch();

	$estado = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados` WHERE slug = ? AND regiao_id = ?");
	$estado->execute(array($url[2],$regiao_info['id']));
	if($estado->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'regioes');
	}

	//É POR QUE MINHA NOTICIA EXISTE
	$estado = $estado->fetch();
    
    $municipio = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios` WHERE slug = ? AND regiao_id = ? AND estado_id = ?");
    $municipio->execute(array($url[3],$regiao_info['id'],$estado['id']));
    if($municipio->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'regioes');
	}

    $municipio = $municipio->fetch();
   
    
?>


<div class="text container">
    <div class="row">
        <div class=" col-sm-12 text-center my-3">
            <h1><?php echo $municipio['nome_municipio']; ?></h1>
        </div>
    </div>
    
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-mdbetween py-3 mb-3">
        <iframe width="750" height="422" src="<?php echo $municipio['link_video']; ?>" title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>

    </div>

    <div class="row">
        <div class=" col-sm-12 col-md-6 ">
            <p>
                <strong ><?php echo $municipio['nome_municipio']; ?></strong>
            </p>

            <p>
                <?php echo $municipio['descricao']; ?>
            </p>
        </div>

        <div class="col-sm-12 col-md-6">
            <img class="img-fluid" width="550" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $municipio['imagem']; ?>" alt="<?php echo $municipio['descricao_imagem']?>">
            <p class="text-muted text-end">
                <strong><?php echo $municipio['descricao_imagem'];?></strong>
            </p>
        </div>
    </div>
</div>