<h2 class="mb-3">Adicionar nova região</h2>
<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['acao'])){
				$nome = $_POST['nome_regiao'];
				$descricao = $_POST['descricao'];
				$descricao_imagem = $_POST['descricao_imagem'];
				$imagem = $_FILES['imagem'];

				if($nome == '' || $descricao == ''|| $descricao_imagem == ''){
					Painel::alert('erro','Campos vazios não são permitidos!');
				}else if($imagem['tmp_name'] == '' ){
					Painel::alert('erro','A imagem da região precisa ser selecionada.');
				}else{
					if(Painel::imagemValida($imagem)){
						$verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes` WHERE nome_regiao =?");
						$verifica->execute(array($nome));
						if($verifica->rowCount() == 0){
						$arquivo = Painel::uploadFile($imagem);
						$slug = Painel::generateSlug($nome);
						$arr = ['nome_regiao'=>$nome,
						'slug'=>$slug,
						'descricao'=>$descricao,
						'imagem'=>$arquivo,
						'descricao_imagem'=>$descricao_imagem,
						'order_id'=>'0',
						'nome_tabela'=>'tb_site.regioes'
						];
						if(Painel::insert($arr)){
							Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-regiao?sucesso');
						}

						//Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
						}else{
							Painel::alert('erro','Já existe uma região com esse nome!');
						}
					}else{
						Painel::alert('erro','Selecione uma imagem válida!');
					}
					
				}
				
				
			}
			if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
				Painel::alert('sucesso','O cadastro da região foi realizado com sucesso!');
			}
		?>

	<div class="mb-3">
		<label for="nome" class="form-label">Nome:</label>
		<select name="nome_regiao" id="sltRegioesUnico" class="form-select select2" value="<?php recoverPost('nome'); ?>"></select>
	</div>
	

	<div class="mb-3">
		<label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>"></textarea>
	</div>

	<div class="mb-3">
		<label for="imagem" class="form-label">Imagem</label>
		<input type="file" name="imagem" class="form-control">
	</div>

    <div class="mb-3">
		<label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
		<input type="text" name="descricao_imagem" required class="form-control" value="<?php recoverPost('descricao_imagem');?>">
	</div>

    <input type="hidden" name="order_id" value="0">
	<input type="hidden" name="nome_tabela" value="tb_site.regioes" /> 

	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Cadastrar</button>

	</form>