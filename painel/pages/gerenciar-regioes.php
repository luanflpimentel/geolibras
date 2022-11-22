
<?php
    if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		

        // Deletar a imagem do banco de dados

        $selectImagemRegiao = MySql::conectar()->prepare("SELECT imagem FROM `tb_site.regioes` WHERE id = ?");
		$selectImagemRegiao->execute(array($_GET['excluir']));

		$imagem = $selectImagemRegiao->fetch()['imagem'];
        Painel::deleteFile($imagem);

        // Deletar o registro da região do banco de dados
        Painel::deletar('tb_site.regioes',$idExcluir);

        //Excluir estados vinculados a região

        $estados = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados` WHERE regiao_id = ?");
		$estados->execute(array($idExcluir));
		$estados = $estados->fetchAll();
		foreach ($estados as $key => $value) {
			$imgDelete = $value['imagem'];
			Painel::deleteFile($imgDelete);
		}
		$estados = MySql::conectar()->prepare("DELETE FROM `tb_site.estados` WHERE regiao_id = ?");
		$estados->execute(array($idExcluir));

        // Excluir municípios vinculados a região

        $municipios = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios` WHERE regiao_id = ?");
		$municipios->execute(array($idExcluir));
		$municipios = $municipios->fetchAll();
		foreach ($municipios as $key => $value) {
			$imgDelete = $value['imagem'];
			Painel::deleteFile($imgDelete);
		}
		$municipios = MySql::conectar()->prepare("DELETE FROM `tb_site.municipios` WHERE regiao_id = ?");
		$municipios->execute(array($idExcluir));

		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-regioes');
	}

    
	
	$regioes = Painel::selectAll('tb_site.regioes');

?>

<h2 class="mb-3 text-center">Regiões cadastradas</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
    <thead class="cor-padrao ">
        <tr>
        <th scope="col">Nome da região</th>
        <th scope="col">Descrição</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody class="table-group-divider table-light">
        <?php
            foreach ($regioes as $key => $value) {
        ?>

        <tr>
        <td><?php echo $value['nome_regiao']; ?></td>
        <td class="maxTexto"><?php echo $value['descricao']; ?></td>
        
        <td>
            <div class="text-center">

                <a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-regiao?id=<?php echo $value['id']; ?>">
                    <button class="btn btn-sm btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button>
                </a>

                
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value['id'];?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/> 
                    </svg>
                </button>
            </div>
        </td>

        </tr>

        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?php echo $value['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir região</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir a região <?php echo $value['nome_regiao']; ?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <button  type="button" class="btn btn-primary cor-padrao">
                    <a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-regioes?excluir=<?php echo $value['id']; ?>">
                        Sim, excluir!    
                    </a>
                </button>
            </div>
            </div>
        </div>
        </div>

        <?php } ?>

        
        
    </tbody>
    </table>

    
    <div class="text-center pt-3">
        <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-regiao">
            <button type="button" class="btn btn-primary cor-padrao ">
                Adicionar nova região
            </button>
        </a>
    </div>
    
        
</div>