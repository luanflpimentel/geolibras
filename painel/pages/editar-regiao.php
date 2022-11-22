<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$regiao = Painel::select('tb_site.regioes','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>

<h2 class="mb-3">Editar região</h2>

<form method="post" enctype="multipart/form-data">

	<?php
		if(isset($_POST['acao'])){
			//Enviei o meu formulário.
			
			$nome = $_POST['nome_regiao'];
			$descricao = $_POST['descricao'];
			$imagem = $_FILES['imagem'];
			$descricao_imagem = $_POST['descricao_imagem'];
			$imagem_atual = $_POST['imagem_atual'];
			$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.regioes` WHERE nome_regiao = ? AND id != ?");
			$verifica->execute(array($nome,$id));
			if($verifica->rowCount() == 0){
			if($imagem['name'] != ''){
				//Existe o upload de imagem.
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem = Painel::uploadFile($imagem);
					$slug = Painel::generateSlug($nome);
					$arr = ['nome_regiao'=>$nome,
					'slug'=>$slug,
					'descricao'=>$descricao,
					'imagem'=>$imagem,
					'descricao_imagem'=>$descricao_imagem,
					'id'=>$id,
					'nome_tabela'=>'tb_site.regioes'];
					Painel::update($arr);
					$regiao = Painel::select('tb_site.regioes','id = ?',array($id));
					Painel::alert('sucesso','A região foi editada com sucesso junto com a imagem!');
				}else{
					Painel::alert('erro','O formato da imagem não é válido');
				}
			}else{
				$imagem = $imagem_atual;
				$slug = Painel::generateSlug($nome);
				$arr = ['nome_regiao'=>$nome,
				'slug'=>$slug,
				'descricao'=>$descricao,
				'imagem'=>$imagem,
				'descricao_imagem'=>$descricao_imagem,
				'id'=>$id,
				'nome_tabela'=>'tb_site.regioes'];
				Painel::update($arr);
				$regiao = Painel::select('tb_site.regioes','id = ?',array($id));
				Painel::alert('sucesso','A região foi editada com sucesso!');
			}
			}else{
				Painel::alert('erro','Já existe uma região com este nome!');
			}

		}
	?>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
			<select name="nome_regiao"  class="form-select select2">
				<option value="<?php echo $regiao['nome_regiao']; ?>"><?php echo $regiao['nome_regiao']; ?></option>
        	</select>
            
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            
			<textarea name="descricao" id="floatingTextarea" class="form-control tinymce"><?php echo $regiao['descricao']; ?></textarea>
        </div>

		<div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control">
            <input type="hidden" name="imagem_atual" value="<?php echo $regiao['imagem']; ?>">
        </div>

        <div class="mb-3">
            <label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
            <input type="text" name="descricao_imagem" required class="form-control" value="<?php echo $regiao['descricao_imagem']; ?>">
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="nome_tabela" value="tb_site.regioes" />

        <button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>

		
	</form>