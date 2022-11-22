<h2 class="mb-3">Cadastrar novo município</h2>
<form method="post" enctype="multipart/form-data">
    <?php

    if(isset($_POST['acao'])){
        $regiao_id = $_POST['regiao_id'];
        $estado_id = $_POST['estado_id'];
        $nome = $_POST['nome_municipio'];
        $descricao = $_POST['descricao'];
        $link_video = $_POST['link_video'];
        $descricao_imagem = $_POST['descricao_imagem'];
        $imagem = $_FILES['imagem'];

        if($nome == '' || $descricao == ''|| $link_video == ''|| $descricao_imagem == ''){
            Painel::alert('erro','Campos vazios não são permitidos!');
        }else if($imagem['tmp_name'] == '' ){
            Painel::alert('erro','A imagem do município precisa ser selecionada.');
        }else{
            if(Painel::imagemValida($imagem)){
                $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios` WHERE nome_municipio=? AND estado_id = ? AND regiao_id = ?");
                $verifica->execute(array($nome,$estado_id,$regiao_id));
                if($verifica->rowCount() == 0){
                $arquivo = Painel::uploadFile($imagem);
                $slug = Painel::generateSlug($nome);
                $arr = ['regiao_id'=>$regiao_id,'estado_id'=>$estado_id,'nome_municipio'=>$nome,
                'slug'=>$slug,
                'descricao'=>$descricao,
                'link_video'=>$link_video,
                'imagem'=>$arquivo,
                'descricao_imagem'=>$descricao_imagem,
                'order_id'=>'0',
                'nome_tabela'=>'tb_site.municipios'
                ];
                if(Painel::insert($arr)){
                    Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-municipio?sucesso');
                }

                //Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
                }else{
                    Painel::alert('erro','Já existe um município com esse nome!');
                }
            }else{
                Painel::alert('erro','Selecione uma imagem válida!');
            }
            
        }
        
        
    }
    if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','O cadastro do município foi realizado com sucesso!');
    }
    ?>

	<div class="mb-3">
		<label for="regiao" class="form-label">Região:</label>
		<select name="regiao_id" class="form-select select2" required>
            <?php
				$regioes = Painel::selectAll('tb_site.regioes');
				foreach ($regioes as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['regiao_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_regiao']; ?></option>
			<?php } ?>
        </select>
	</div>

    <div class="mb-3">
		<label for="estado" class="form-label">Estado:</label>
		<select name="estado_id" class="form-select select2" required>
            <?php
				$estados = Painel::selectAll('tb_site.estados');
				foreach ($estados as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['estado_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_estado']; ?></option>
			<?php } ?>
        </select>
	</div>

    <div class="mb-3">
		<label for="nome" class="form-label">Nome do município:</label>
        <select required name="nome_municipio" id="sltMunicipiosUnico" class="form-select select2" value="<?php recoverPost('nome_municipio'); ?>"></select>
	</div>


	<div class="mb-3">
		<label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>"></textarea>
	</div>

    <div class="mb-3">
		<label for="link_video" class="form-label">Link do vídeo:</label>
		<input type="text" name="link_video" required class="form-control" value="<?php recoverPost('link_video'); ?>">
	</div>

    <div class="mb-3">
		<label for="imagem" class="form-label">Imagem</label>
		<input type="file" name="imagem" required class="form-control">
	</div>

    <div class="mb-3">
		<label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
		<input type="text" name="descricao_imagem" required class="form-control" value="<?php recoverPost('descricao_imagem');?>">
	</div>

    <input type="hidden" name="order_id" value="0">
	<input type="hidden" name="nome_tabela" value="tb_site.municipios" />                
	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Cadastrar</button>

</form>