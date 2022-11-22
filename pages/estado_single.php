<?php
	$url = explode('/',$_GET['url']);
	if(!isset($url[3])){
	$verifica_regiao = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` WHERE slug = ?");
	$verifica_regiao->execute(array($url[1]));
	if($verifica_regiao->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'regioes');
	}
	$regiao_info = $verifica_regiao->fetch();

	$estado = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados` WHERE slug = ? AND regiao_id = ?");
	$estado->execute(array($url[2],$regiao_info['id']));
	if($estado->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'regioes/');
	}

	//É POR QUE EXISTE
	$estado = $estado->fetch();
    
    $municipios = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios` WHERE estado_id = ?");
    $municipios->execute(array($estado['id']));

	// LISTAGEM ALFABÉTICA

	$query_letras = MySql::conectar()->prepare("SELECT DISTINCT LEFT (nome_municipio, 1) AS inicial FROM `tb_site.municipios` WHERE estado_id = ? ORDER BY nome_municipio");
	$query_letras->execute(array($estado['id']));
   
    
?>

<div class="container">

	

		<!-- LISTAGEM ALFABÉTICA -->

		<!-- <?php
			while($letra = $query_letras->fetchObject()){
				$letras[] = $letra->inicial;
			}

			foreach($letras AS $letra){
				echo '<h3>' .$letra. '</h3>';

				$municipiosListagem = MySql::conectar()->prepare("SELECT `nome_municipio` FROM `tb_site.municipios` WHERE nome_municipio LIKE '$letra%' ORDER BY nome_municipio");
				$municipiosListagem->execute();
			  echo '<ul>';

				while($c = $municipiosListagem->fetch()){
					echo '<li>' . $c['nome_municipio'] . '</li>';
				}

				echo '</ul>';
			}
		?> -->

		<!-- LISTAGEM ALFABÉTICA -->


		<div class="row">
			<div class="col-sm-12  my-3">
				<h1 class="text-center text"><?php echo $estado['nome_estado'] ?></h1>
				
				
			</div>
		</div>

		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-mdbetween py-3 mb-3">
        <iframe width="750" height="422" src="<?php echo $estado['link_video']; ?>" title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>

    </div>

    <div class="row">
        <div class="col text">
			<?php echo $estado['descricao']; ?>
        </div>
    </div>

	<div class="row mb-3">
		<div class="col">
			<h3 class="text-muted text-center" >Municípios</h3>
		</div>
	</div>

		<?php
			$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.municipios` WHERE estado_id = ?");
			$verifica->execute(array($estado['id']));
			if($verifica->rowCount() >= 1){
		
		?>
	
		<div class="row mb-3">
			<div class="accordion" id="acordeaoLetras">
				<?php 
					while($letra = $query_letras->fetch()){
						$letras[] = $letra->inicial;
					}

					foreach($letras AS $letra){
						$municipiosListagem = MySql::conectar()->prepare("SELECT `nome_municipio`, `slug` FROM `tb_site.municipios` WHERE nome_municipio LIKE '$letra%' AND estado_id = ? ORDER BY nome_municipio");
						$municipiosListagem->execute(array($estado['id']));
						
				?>
				<div class="bkg2-bg accordion-item">
					<h2 class="accordion-header" id="heading<?php echo $letra ?>">
					
						<button class="text bkg2-bg accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $letra ?>" aria-expanded="true" aria-controls="collapse<?php echo $letra ?>">
						<?php echo $letra ?>
						</button>
					</h2>

					
					<?php while($m = $municipiosListagem->fetch()){ ?>	
					<div id="collapse<?php echo $letra ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $letra ?>" data-bs-parent="#acordeaoLetras">
					
						<div class="accordion-body py-2">
								
								<li class="list-group">
									
									<a href="<?php echo INCLUDE_PATH ?>regioes/<?php echo $regiao_info['slug']; ?>/<?php echo $estado['slug']; ?>/<?php echo $m['slug']?>" class="text bkg2-bg list-group-item list-group-item-action"><?php echo $m['nome_municipio']?></a> 
									
								</li>
								
						</div>
						
					</div>
					<?php } ?>
				</div>
				
				<?php }  ?>
				
			</div>
			
			<?php } else {
					Painel::alert('info','Ainda não há nenhum município cadastrado nesse estado.');
				}?>
		</div>
</div>




<?php }else{ 
	
    include('municipio_single.php');
}
?>
