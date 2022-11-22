<h2 class="mb-3">Cadastrar novo estado</h2>
<form method="post" enctype="multipart/form-data">
    <?php

        if(isset($_POST['acao'])){
            $regiao_id = $_POST['regiao_id'];
            $nome = $_POST['nome_estado'];
            $descricao = $_POST['descricao'];
            $capital = $_POST['capital'];
            $link_video = $_POST['link_video'];
            $qtde_municipios = $_POST['qtde_municipios'];
            $descricao_imagem = $_POST['descricao_imagem'];
            $imagem = $_FILES['imagem'];

            if($nome == '' || $descricao == ''|| $capital == '' || $qtde_municipios == '' || $descricao_imagem == ''){
                Painel::alert('erro','Campos vazios não são permitidos!');
            }else if($imagem['tmp_name'] == '' ){
                Painel::alert('erro','A imagem do estado precisa ser selecionada.');
            }else{
                if(Painel::imagemValida($imagem)){
                    $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados` WHERE nome_estado=? AND regiao_id = ?");
                    $verifica->execute(array($nome,$regiao_id));
                    if($verifica->rowCount() == 0){
                    $arquivo = Painel::uploadFile($imagem);
                    $slug = Painel::generateSlug($nome);
                    $arr = ['regiao_id'=>$regiao_id,
                    'nome_estado'=>$nome,
                    'slug'=>$slug,
                    'descricao'=>$descricao,
                    'capital'=>$capital,
                    'link_video'=>$link_video,
                    'qtde_municipios'=>$qtde_municipios,
                    'imagem'=>$arquivo,
                    'descricao_imagem'=>$descricao_imagem,
                    'order_id'=>'0',
                    'nome_tabela'=>'tb_site.estados'
                    ];
                    if(Painel::insert($arr)){
                        Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-estado?sucesso');
                    }

                    }else{
                        Painel::alert('erro','Já existe um estado com esse nome!');
                    }
                }else{
                    Painel::alert('erro','Selecione uma imagem válida!');
                }
                
            }
            
            
        }
        if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
            Painel::alert('sucesso','O cadastro do estado foi realizado com sucesso!');
        }
        ?>

	<div class="mb-3">
		<label for="regiao" class="form-label">Região:</label>
		<select name="regiao_id"  class="form-select select2" required>
            <?php
				$regioes = Painel::selectAll('tb_site.regioes');
				foreach ($regioes as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['regiao_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome_regiao']; ?></option>
			<?php } ?>
        </select>
	</div>

    <div class="mb-3">
		<label for="nome" class="form-label">Nome do estado:</label>
        <select required name="nome_estado" id="sltEstadosUnico" class="form-select select2" value="<?php recoverPost('nome_estado'); ?>"></select>
	</div>


	<div class="mb-3">
		<label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>"></textarea>
	</div>

    <div class="mb-3">
		<label for="capital" class="form-label">Capital:</label>
        <select required name="capital" id="sltMunicipiosUnico" class="form-select select2" value="<?php recoverPost('capital'); ?>"></select>
	</div>

    <div class="mb-3">
		<label for="link_video" class="form-label">Link do vídeo:</label>
		<input type="text" name="link_video" required class="form-control" value="<?php recoverPost('link_video'); ?>">
	</div>

    <div class="mb-3">
		<label for="Quantidade de municípios" class="form-label">Quantidade de municípios:</label>
		<input type="number" name="qtde_municipios" required class="form-control" value="<?php recoverPost('qtde_municipios'); ?>">
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
	<input type="hidden" name="nome_tabela" value="tb_site.estados" />                
	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Cadastrar</button>

	</form>