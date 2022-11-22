<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$pesquisador = Painel::select('tb_site.pesquisadores','id = ?',array($id));
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
				
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$imagem = $_FILES['imagem'];
                $link_lattes = $_POST['link_lattes'];
				$imagem_atual = $_POST['imagem_atual'];
				$descricao_imagem = $_POST['descricao_imagem'];
				
				if($imagem['name'] != ''){
					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$arr = ['nome'=>$nome,
                        'descricao'=>$descricao,
                        'imagem'=>$imagem,
						'descricao_imagem'=>$descricao_imagem,
						'link_lattes'=>$link_lattes,
                        'id'=>$id,'nome_tabela'=>'tb_site.pesquisadores'];
						Painel::update($arr);
						$pesquisador = Painel::select('tb_site.pesquisadores','id = ?',array($id));
						Painel::alert('sucesso','O pesquisador '.$nome. ' foi editado com sucesso junto com a imagem!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['nome'=>$nome,
                    'descricao'=>$descricao,
                    'imagem'=>$imagem,
					'descricao_imagem'=>$descricao_imagem,
                    'link_lattes'=>$link_lattes,
                    'id'=>$id,'nome_tabela'=>'tb_site.pesquisadores'];
					Painel::update($arr);
					$pesquisador = Painel::select('tb_site.pesquisadores','id = ?',array($id));
					Painel::alert('sucesso','O pesquisador ' .$nome. ' foi editado com sucesso!');
				}
				
            }
		?>

        

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" required class="form-control" value="<?php echo $pesquisador['nome'] ?>">
        </div>

		<div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>">
                <?php echo $pesquisador['descricao']; ?>
            </textarea>
	    </div>

		<div class="mb-3">
            <label for="link_lattes" class="form-label">Link do currículo lattes:</label>
            <input type="text" name="link_lattes" required class="form-control" value="<?php echo $pesquisador['link_lattes'] ?>">
        </div>

		<div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control">
            <input type="hidden" name="imagem_atual" value="<?php echo $pesquisador['imagem']; ?>">
        </div>

		<div class="mb-3">
			<label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
			<input type="text" name="descricao_imagem" required class="form-control" value="<?php echo $pesquisador['descricao_imagem'] ?>">
		</div>


		<button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>

	</form>