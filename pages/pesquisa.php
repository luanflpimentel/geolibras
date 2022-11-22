<!-- PESQUISA E PAGINAÇÃO -->

<?php 

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
$quantidade = 10;
$inicio = ($quantidade * $pagina) - $quantidade;


if(!empty($_GET['search'])){
    
    $data = $_GET['search'];
    $pesquisa = MySql::conectar()->prepare("SELECT *, `tb_site.regioes`.`slug` AS 'slug_regiao',
    `tb_site.estados`.`slug` AS 'slug_estado', `tb_site.municipios`.`slug` AS 'slug_municipio'
    FROM `tb_site.municipios`
    INNER JOIN `tb_site.regioes` ON `tb_site.municipios`.`regiao_id` = `tb_site.regioes`.`id` 
    INNER JOIN `tb_site.estados` ON `tb_site.municipios`.`estado_id` = `tb_site.estados`.`id`
    WHERE `tb_site.municipios`.`nome_municipio` LIKE '%$data%'
    OR `tb_site.estados`.`nome_estado` LIKE '%$data%'
    OR `tb_site.regioes`.`nome_regiao` LIKE '%$data%'
    
    ORDER BY `tb_site.municipios`.`nome_municipio` ASC
    LIMIT $inicio, $quantidade
    ");
    
    
} else {
    Painel::redirect(INCLUDE_PATH.'regioes');
    
    
}
$pesquisa->execute();

?>

<!-- PESQUISA E PAGINAÇÃO -->

<!-- RESULTADO DA PESQUISA -->

<h4 class="text text-center">Mostrando resultados da pesquisa: <?php echo $data; ?></h4>
<ul class="text list-group my-3">
<?php

    while($dados = $pesquisa->fetch()){
        
?>

    
        <li class="text bkg2-bg list-group-item">
            <a href="<?php echo INCLUDE_PATH ?>regioes/<?php echo $dados['slug_regiao']; ?>/<?php echo $dados['slug_estado']; ?>/<?php echo $dados['slug_municipio']?>" class="text bkg2-bg list-group-item list-group-item-action"><?php echo $dados['nome_municipio']?></a>
        </li>                       
         
    

    

<?php }?>
</ul>


<!-- RESULTADO DA PESQUISA -->


<ul class=" pagination justify-content-center">
    <?php

        $sqlTotal = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.municipios`");
        $qrTotal = $sqlTotal->execute();
        $numTotal = $sqlTotal->rowCount();

        $totalPagina = ceil($numTotal / $quantidade);

        

        echo '<li class=" page-item"><a class="page-link" href="'.INCLUDE_PATH.'pesquisa?pagina=1&search='.$data.'">Primeira Pagina</a></li>';

        if($pagina>4){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH ?>pesquisa?pagina=<?php echo $pagina-1?>&search=<?php echo $data;?>">
            <span aria-hidden="true">&laquo;</span>
            </a></li>
            <?php
        }


        for($i=1;$i<=$totalPagina;$i++){
            
           if($i>=($pagina-3) && $i <= ($pagina+3)){
            if($i==$pagina){
                echo "<li class='page-item active'><span class='page-link cor-padrao'>$i</span></li>";
            }else{
                
                echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'pesquisa?pagina='.$i.'&search='.$data.'"> '.$i.' </a></li>';
                                                                
            }
           }
        }

        if($pagina<$totalPagina-3){
            ?>
            <li class="page-item"><a class="page-link" href="<?php INCLUDE_PATH ?>pesquisa?pagina=<?php echo $pagina+1?>&search=<?php echo $data; ?>">
            <span aria-hidden="true">&raquo;</span>
            </a></li>
            <?php
        }
        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'pesquisa?pagina='.$totalPagina.'&search='.$data.'">Última Pagina</a></li>';


    ?>
    </ul>

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
            window.location = '<?php echo INCLUDE_PATH ?>?search='+search.value;
        }
    </script>