
<?php
    if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_admin.usuarios',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-usuarios');
	}

    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $quantidade = 10;
    $inicio = ($quantidade * $pagina) - $quantidade;
    
    
    if(!empty($_GET['search'])){
        
        $data = $_GET['search'];
        $pesquisa = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`
        
        WHERE `nome` LIKE '%$data%'
        ORDER BY `nome` ASC
        LIMIT $inicio, $quantidade
        ");
        
        
    } else {
        $data = "";
        $pesquisa = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`
        ORDER BY `nome` ASC
        LIMIT $inicio, $quantidade
        ");
        
        
    }
    $pesquisa->execute();

    

?>

<h2 class="mb-3 text-center">Usuários cadastrados</h2>

<div class="mb-3 box-search">
    <input type="search" class="form-control w-50" placeholder="Pesquise pelo nome do usuário" id="pesquisar" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
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
        <th scope="col">Nome</th>
        <th scope="col">Usuário</th>
        <th scope="col">Cargo</th>
        <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody class="table-group-divider table-light">
        <?php
            while ($dados = $pesquisa->fetch()) {
        ?>

        <tr>
        <td><?php echo $dados['nome']; ?></td>
        <td><?php echo $dados['user']; ?></td>
        <td><?php if($dados['cargo'] == '2') : echo "Administrador"; endif;
                    if ($dados['cargo'] == '1') : echo "Sub-Administrador"; endif;
                    if ($dados['cargo'] == '0') : echo "Normal"; endif; ?></td>
        <td>
            <div class="text-center">

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
                <h5 class="modal-title" id="exampleModalLabel">Excluir usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir o usuário <?php echo $dados['user']; ?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <button  type="button" class="btn btn-primary cor-padrao">
                    <a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-usuarios?excluir=<?php echo $dados['id']; ?>">
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

        $sqlTotal = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios`");
        $qrTotal = $sqlTotal->execute();
        $numTotal = $sqlTotal->rowCount();

        $totalPagina = ceil($numTotal / $quantidade);

        echo "<li class='page-item'><span class='page-link'>Total de registros: " . $numTotal . " </span></li> ";

        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-usuarios?pagina=1&search='.$data.'">Primeira Pagina</a></li>';

        if($pagina>4){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-usuarios?pagina=<?php echo $pagina-1?>&search=<?php echo $data;?>">
            <span aria-hidden="true">&laquo;</span>
            </a></li>
            <?php
        }


        for($i=1;$i<=$totalPagina;$i++){
            
           if($i>=($pagina-3) && $i <= ($pagina+3)){
            if($i==$pagina){
                echo "<li class='page-item active'><span class='page-link cor-padrao'>$i</span></li>";
            }else{
                
                echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-usuarios?pagina='.$i.'&search='.$data.'"> '.$i.' </a></li>';
                                                                
            }
           }
        }

        if($pagina<$totalPagina-3){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-usuarios?pagina=<?php echo $pagina+1?>&search=<?php echo $data; ?>">
            <span aria-hidden="true">&raquo;</span>
            </a></li>
            <?php
        }
        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH_PAINEL.'gerenciar-usuarios?pagina='.$totalPagina.'&search='.$data.'">Última Pagina</a></li>';


?>
</ul>

    <div class="text-center pt-3">
        <a href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">
            <button type="button" class="btn btn-primary cor-padrao ">
                Adicionar novo usuário
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
        window.location = '<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-usuarios?search='+search.value;
    }
</script>
