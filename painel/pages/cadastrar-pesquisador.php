<h2 class="mb-3">Cadastrar novo pesquisador</h2>
<form method="post" enctype="multipart/form-data">
    <?php

    if(isset($_POST['acao'])){
        
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $link_lattes = $_POST['link_lattes'];
        $imagem = $_FILES['imagem'];
        $descricao_imagem = $_POST['descricao_imagem'];

        if($nome == '' || $descricao == ''|| $link_lattes == ''){
            Painel::alert('erro','Campos vázios não são permitidos!');
        }else if($imagem['tmp_name'] == '' ){
            Painel::alert('erro','A imagem do pesquisador precisa ser selecionada.');
        }else{
            if(Painel::imagemValida($imagem)){
                
                $arquivo = Painel::uploadFile($imagem);
                $arr = ['nome'=>$nome,
                'descricao'=>$descricao,
                'imagem'=>$arquivo,
                'descricao_imagem'=>$descricao_imagem,
                'link_lattes'=>$link_lattes,
                'order_id'=>'0',
                'nome_tabela'=>'tb_site.pesquisadores'
                ];
                if(Painel::insert($arr)){
                    Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-pesquisador?sucesso');
                }
            }else{
                Painel::alert('erro','Selecione uma imagem válida!');
            }
            
        }
        
        
    }
    if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','O cadastro do pesquisador foi realizado com sucesso!');
    }
    ?>

	
    <div class="mb-3">
		<label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" required class="form-control" value="<?php recoverPost('nome');?>">
	</div>


	<div class="mb-3">
		<label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="floatingTextarea" class="form-control tinymce" value="<?php recoverPost('descricao'); ?>"></textarea>
	</div>

    <div class="mb-3">
		<label for="link_lattes" class="form-label">Link do currículo lattes:</label>
		<input type="text" name="link_lattes" required class="form-control" value="<?php recoverPost('link_lattes');?>">
	</div>

    <div class="mb-3">
		<label for="imagem" class="form-label">Foto do pesquisador</label>
		<input type="file" name="imagem" required class="form-control">
	</div>

    <div class="mb-3">
		<label for="descricao_imagem" class="form-label">Descrição da imagem:</label>
		<input type="text" name="descricao_imagem" required class="form-control" value="<?php recoverPost('descricao_imagem');?>">
	</div>

    <input type="hidden" name="order_id" value="0">
	<input type="hidden" name="nome_tabela" value="tb_site.pesquisadores" />                
	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Cadastrar</button>

</form>