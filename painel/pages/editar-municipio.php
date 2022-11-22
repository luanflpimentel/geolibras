<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$municipio = Painel::select('tb_site.municipios','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<h2 class="mb-3">Editar município</h2>

<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				
				$nome = $_POST['nome_municipio'];
				$descricao = $_POST['descricao'];
				$imagem = $_FILES['imagem'];
                $link_video = $_POST['link_video'];
                $descricao_imagem = $_POST['descricao_imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.municipios` WHERE nome_municipio = ? AND regiao_id = ? AND estado_id = ? AND id != ?");
				$verifica->execute(array($nome,$_POST['regiao_id'],$_POST['estado_id'],$id));
				if($verifica->rowCount() == 0){
				if($imagem['name'] != ''){
					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$slug = Painel::generateSlug($nome);
						$arr = ['nome_municipio'=>$nome,
                        'regiao_id'=>$_POST['regiao_id'],
                        'estado_id'=>$_POST['regiao_id'],
                        'descricao'=>$descricao,
                        'imagem'=>$imagem,
                        'slug'=>$slug,
                        'link_video'=>$link_video,
                        'descricao_imagem'=>$descricao_imagem,
                        'id'=>$id,'nome_tabela'=>'tb_site.municipios'];
						Painel::update($arr);
						$municipio = Painel::select('tb_site.municipios','id = ?',array($id));
						Painel::alert('sucesso','O município foi editado com sucesso junto com a imagem!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$slug = Painel::generateSlug($nome);
					$arr = ['nome_municipio'=>$nome,
                    'regiao_id'=>$_POST['regiao_id'],
                    'estado_id'=>$_POST['estado_id'],
                    'descricao'=>$descricao,
                    'imagem'=>$imagem,
                    'slug'=>$slug,
                    'link_video'=>$link_video,
                    'descricao_imagem'=>$descricao_imagem,
                    'id'=>$id,'nome_tabela'=>'tb_site.municipios'];
					Painel::update($arr);
					$municipio = Painel::select('tb_site.municipios','id = ?',array($id));
					Painel::alert('sucesso','O município foi editada com sucesso!');
				}
				}else{
					Painel::alert('erro','Já existe um município com este nome!');
				}

			}
		?>

        <div class="mb-3">
            <label for="regiao" class="form-label">Região:</label>
            <select name="regiao_id" class="form-select select2">
                <?php
                    $regioes = Painel::selectAll('tb_site.regioes');
                    foreach ($regioes as $key => $value) {
                ?>
                <option <?php if($value['id'] == $municipio['regiao_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_regiao']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado_id" class="form-select select2">
            <?php
				$estados = Painel::selectAll('tb_site.estados');
				foreach ($estados as $key => $value) {
			?>
			<option <?php if($value['id'] == $municipio['estado_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_estado']; ?></option>
			<?php } ?>
            </select>
	    </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do município:</label>
            <select name="nome_municipio" class="form-select select2">
            <option  class="" value="<?php echo $municipio['nome_municipio'] ?>"><?php echo $municipio['nome_municipio']; ?></option>
            </select>
        </div>

		<div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>">
                <?php echo $municipio['descricao']; ?>
            </textarea>
	    </div>

		<div class="mb-3">
            <label for="link_video" class="form-label">Link do vídeo:</label>
            <input type="text" name="link_video" required class="form-control" value="<?php echo $municipio['link_video'] ?>">
        </div>

		<div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control">
            <input type="hidden" name="imagem_atual" value="<?php echo $municipio['imagem']; ?>">
        </div>

        <div class="mb-3">
            <label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
            <input type="text" name="descricao_imagem" required class="form-control" value="<?php echo $municipio['descricao_imagem']; ?>">
        </div>

		<button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>

	</form>