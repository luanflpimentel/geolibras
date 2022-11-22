<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$estado = Painel::select('tb_site.estados','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<h2 class="mb-3">Editar estado</h2>

<form method="post" enctype="multipart/form-data">

<?php
		if(isset($_POST['acao'])){
			//Enviei o meu formulário.

			$regiao_id = $_POST['regiao_id'];
			$nome = $_POST['nome_estado'];
			$descricao = $_POST['descricao'];
			$capital = $_POST['capital'];
			$link_video = $_POST['link_video'];
            $qtde_municipios = $_POST['qtde_municipios'];
			$imagem = $_FILES['imagem'];
			$descricao_imagem = $_POST['descricao_imagem'];
			$imagem_atual = $_POST['imagem_atual'];

			$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.estados` WHERE nome_estado = ? AND regiao_id = ? AND id != ?");
			$verifica->execute(array($nome,$regiao_id,$id));
			if($verifica->rowCount() == 0){
			if($imagem['name'] != ''){
				//Existe o upload de imagem.
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem = Painel::uploadFile($imagem);
					$slug = Painel::generateSlug($nome);
					$arr = ['regiao_id'=>$regiao_id,
					'nome_estado'=>$nome,
					'slug'=>$slug,
					'descricao'=>$descricao,
					'capital'=>$capital,
					'link_video'=>$link_video,
					'qtde_municipios'=>$qtde_municipios,
					'imagem'=>$imagem,
					'descricao_imagem'=>$descricao_imagem,
					'id'=>$id,
					'nome_tabela'=>'tb_site.estados'];
					Painel::update($arr);
					$estado = Painel::select('tb_site.estados','id = ?',array($id));
					Painel::alert('sucesso','O estado foi editada com sucesso junto com a imagem!');
				}else{
					Painel::alert('erro','O formato da imagem não é válido');
				}
			}else{
				$imagem = $imagem_atual;
				$slug = Painel::generateSlug($nome);
				$arr = ['regiao_id'=>$regiao_id,
				'nome_estado'=>$nome,
				'slug'=>$slug,
				'descricao'=>$descricao,
				'capital'=>$capital,
				'link_video'=>$link_video,
				'qtde_municipios'=>$qtde_municipios,
				'imagem'=>$imagem,
				'descricao_imagem'=>$descricao_imagem,
				'id'=>$id,
				'nome_tabela'=>'tb_site.estados'];
				Painel::update($arr);
				$estado = Painel::select('tb_site.estados','id = ?',array($id));
				Painel::alert('sucesso','O estado foi editada com sucesso!');
			}
			}else{
				Painel::alert('erro','Já existe um estado com este nome!');
			}

		}
	?>

    <div class="mb-3">
		<label for="regiao" class="form-label">Região:</label>
		<select name="regiao_id"  class="form-select select2" required>
            <?php
				$regioes = Painel::selectAll('tb_site.regioes');
				foreach ($regioes as $key => $value) {
			?>
			<option <?php if($value['id'] == $estado['regiao_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_regiao']; ?></option>
			<?php } ?>
        </select>
	</div>

    <div class="mb-3">
		<label for="nome" class="form-label">Nome do estado:</label>
        <select name="nome_estado"  class="form-select select2">

			<option  class="" value="<?php echo $estado['nome_estado'] ?>"><?php echo $estado['nome_estado']; ?></option>

        </select>
	</div>

    <div class="mb-3">
		<label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>"><?php echo $estado['descricao']; ?></textarea>
	</div>

    <div class="mb-3">
		<label for="capital" class="form-label">Capital:</label>
		<input type="text" name="capital" required class="form-control" value="<?php echo $estado['capital']; ?>">
	</div>

	<div class="mb-3">
            <label for="link_video" class="form-label">Link do vídeo:</label>
            <input type="text" name="link_video" required class="form-control" value="<?php echo $estado['link_video'] ?>">
    </div>

    <div class="mb-3">
		<label for="Quantidade de municípios" class="form-label">Quantidade de municípios:</label>
		<input type="number" name="qtde_municipios" required class="form-control" value="<?php echo $estado['qtde_municipios'] ?>">
	</div>

	<div class="mb-3">
		<label for="imagem" class="form-label">Imagem</label>
		<input type="file" name="imagem" class="form-control">
		<input type="hidden" name="imagem_atual" value="<?php echo $estado['imagem']; ?>">
	</div>

	<div class="mb-3">
		<label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
		<input type="text" name="descricao_imagem" required class="form-control" value="<?php echo $estado['descricao_imagem']; ?>">
	</div>

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="nome_tabela" value="tb_site.estados" />


    <button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>


		
	</form>