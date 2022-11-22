
<?php
    if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);

        // Deletar a imagem do banco de dados

		$selectImagem = MySql::conectar()->prepare("SELECT imagem FROM `tb_site.municipios` WHERE id = ?");
		$selectImagem->execute(array($_GET['excluir']));

		$imagem = $selectImagem->fetch()['imagem'];
		Painel::deleteFile($imagem);

        // Deletar o registro do banco de dados
		Painel::deletar('tb_site.municipios',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-municipios');
	}

	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $quantidade = 10;
    $inicio = ($quantidade * $pagina) - $quantidade;
    
    
    if(!empty($_GET['search'])){
        
        $data = $_GET['search'];
        $pesquisa = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios`
        /*INNER JOIN `tb_site.regioes` ON `tb_site.municipios`.`regiao_id` = `tb_site.regioes`.`id` 
        INNER JOIN `tb_site.estados` ON `tb_site.municipios`.`estado_id` = `tb_site.estados`.`id`*/
        WHERE `tb_site.municipios`.`nome_municipio` LIKE '%$data%'
        /*OR `tb_site.estados`.`nome_estado` LIKE '%$data%'
        OR `tb_site.regioes`.`nome_regiao` LIKE '%$data%'*/
        
        ORDER BY `tb_site.municipios`.`nome_municipio` ASC
        LIMIT $inicio, $quantidade
        ");
        
        
    } else {
        $data = "";
        $pesquisa = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios`
        ORDER BY `tb_site.municipios`.`nome_municipio` ASC
        LIMIT $inicio, $quantidade
        ");
        
        
    }
    $pesquisa->execute();

?>

<h2 class="mb-3 text-center">Municípios cadastrados</h2>

<div class="mb-3 box-search">

        <input type="search" class="form-control w-50" placeholder="Pesquise pelo nome do município" id="pesquisar" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
        <button onclick="searchData()" class="btn btn-primary cor-padrao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>

</div>


<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
    <thead class="cor-padrao ">
        <tr>
        <th scope="col">Nome do município</th>
        <th scope="col">Estado</th>
        <th scope="col">Região</th>
        <th scope="col">Link do vídeo</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody class="table-group-divider table-light">
        <?php
            while ($dados = $pesquisa->fetch()) {
            $nomeRegiao = Painel::select('tb_site.regioes','id=?',array($dados['regiao_id']))['nome_regiao'];
            $nomeEstado = Painel::select('tb_site.estados','id=?',array($dados['estado_id']))['nome_estado'];
        ?>

        <tr>
        <td><?php echo $dados['nome_municipio']; ?></td>
        <td><?php echo $nomeEstado; ?></td>
        <td><?php echo $nomeRegiao; ?></td>
        <td><a target="blank" href="<?php echo $dados['link_video']; ?>"><?php echo $dados['link_video']; ?></a></td>
        <td>
            <div class="text-center">

                <a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-municipio?id=<?php echo $dados['id']; ?>">
                    <button class="btn btn-sm btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button>
                </a>

                
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $dados['id'];?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/> 
                    </svg>
                </button>
            </div>
        </td>

        </tr>

        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?php echo $dados['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir município</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir o município <?php echo $dados['nome_municipio']; ?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <button  type="button" class="btn btn-primary cor-padrao">
                    <a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-municipios?excluir=<?php echo $dados['id']; ?>">
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

    <ul class="pagination justify-content-center">
    <?php

        $sqlTotal = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.municipios`");
        $qrTotal = $sqlTotal->execute();
        $numTotal = $sqlTotal->rowCount();

        $totalPagina = ceil($numTotal / $quantidade);

        echo "<li class='page-item'><span class='page-link'>Total de registros: " . $numTotal . " </span></li> ";

        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-municipios?pagina=1&search='.$data.'">Primeira Pagina</a></li>';

        if($pagina>4){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-municipios?pagina=<?php echo $pagina-1?>&search=<?php echo $data;?>">
            <span aria-hidden="true">&laquo;</span>
            </a></li>
            <?php
        }


        for($i=1;$i<=$totalPagina;$i++){
            
           if($i>=($pagina-3) && $i <= ($pagina+3)){
            if($i==$pagina){
                echo "<li class='page-item active'><span class='page-link cor-padrao'>$i</span></li>";
            }else{
                
                echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-municipios?pagina='.$i.'&search='.$data.'"> '.$i.' </a></li>';
                                                                
            }
           }
        }

        if($pagina<$totalPagina-3){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-municipios?pagina=<?php echo $pagina+1?>&search=<?php echo $data; ?>">
            <span aria-hidden="true">&raquo;</span>
            </a></li>
            <?php
        }
        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-municipios?pagina='.$totalPagina.'&search='.$data.'">Última Pagina</a></li>';


    ?>
    </ul>

        <div class="text-center pt-3">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-municipio">
                <button type="button" class="btn btn-primary cor-padrao ">
                    Adicionar novo município
                </button>
            </a>
        </div>

            
    </div>

    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") 
            {
                searchData();
            }
        });

        function searchData()
        {
            window.location = '<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-municipios?search='+search.value;
        }
    </script>