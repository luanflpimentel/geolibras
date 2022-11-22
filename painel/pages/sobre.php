<?php
$sobre_info = Painel::select('tb_site.sobre');

?>

<h2 class="mb-3">Sobre o projeto</h2>
<form method="post" enctype="multipart/form-data">

<?php

		if(isset($_POST['acao'])) {
			$sobre = $_POST['sobre'];
			
			if($sobre == ''){
				Painel::alert('erro','O campo sobre está vázio, preencha-o!');
			}else{
				//Podemos cadastrar!
                $arr = ['sobre'=>$sobre,
                'id'=>1,
				'nome_tabela'=>'tb_site.sobre'];
				Painel::update($arr);
				$sobre_info = Painel::select('tb_site.sobre');
				Painel::alert('sucesso','A descrição foi atualizada com sucesso!');
			}
		}
	?>

	<div class="mb-3">
		<label for="sobre" class="form-label">Descrição:</label>
        <textarea name="sobre" id="floatingTextarea" class="form-control tinymce"><?php echo $sobre_info['sobre']; ?></textarea>
	</div>

    <input type="hidden" name="id" value="1">
	<input type="hidden" name="nome_tabela" value="tb_site.sobre" /> 

	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>

	</form>