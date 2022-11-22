<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php


$centro_oeste = MySql::conectar()->prepare("SELECT `nome_estado`,`tb_site.estados`.`slug` AS slug_estado 
        
        FROM `tb_site.estados`
        INNER JOIN `tb_site.regioes` ON `tb_site.estados`.`regiao_id` = `tb_site.regioes`.`id`
        WHERE `tb_site.regioes`.`nome_regiao` = 'Centro-Oeste'
        ORDER BY `tb_site.estados`.`nome_estado` ASC
        ");

$centro_oeste->execute();

$nordeste = MySql::conectar()->prepare("SELECT `nome_estado`,`tb_site.estados`.`slug` AS slug_estado 
        
        FROM `tb_site.estados`
        INNER JOIN `tb_site.regioes` ON `tb_site.estados`.`regiao_id` = `tb_site.regioes`.`id`
        WHERE `tb_site.regioes`.`nome_regiao` = 'Nordeste'
        ORDER BY `tb_site.estados`.`nome_estado` ASC
        ");

$nordeste->execute();

$norte = MySql::conectar()->prepare("SELECT `nome_estado`,`tb_site.estados`.`slug` AS slug_estado 
        
        FROM `tb_site.estados`
        INNER JOIN `tb_site.regioes` ON `tb_site.estados`.`regiao_id` = `tb_site.regioes`.`id`
        WHERE `tb_site.regioes`.`nome_regiao` = 'Norte'
        ORDER BY `tb_site.estados`.`nome_estado` ASC
        ");

$norte->execute();

$sudeste = MySql::conectar()->prepare("SELECT `nome_estado`,`tb_site.estados`.`slug` AS slug_estado 
        
        FROM `tb_site.estados`
        INNER JOIN `tb_site.regioes` ON `tb_site.estados`.`regiao_id` = `tb_site.regioes`.`id`
        WHERE `tb_site.regioes`.`nome_regiao` = 'Sudeste'
        ORDER BY `tb_site.estados`.`nome_estado` ASC
        ");

$sudeste->execute();

$sul = MySql::conectar()->prepare("SELECT `nome_estado`,`tb_site.estados`.`slug` AS slug_estado 
        
        FROM `tb_site.estados`
        INNER JOIN `tb_site.regioes` ON `tb_site.estados`.`regiao_id` = `tb_site.regioes`.`id`
        WHERE `tb_site.regioes`.`nome_regiao` = 'Sul'
        ORDER BY `tb_site.estados`.`nome_estado` ASC
        ");

$sul->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geolibras</title>
    <link href="<?php echo INCLUDE_PATH ?>estilo/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH ?>estilo/style.css" rel="stylesheet">
</head>
<body>
<a href="#principal" accesskey="1" class="skip-to-main-content-link">Pular para o conteúdo principal</a>




<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		
	?>

<div class="container">

        <header>
            <nav class="navbar navbar-expand-lg d-flex align-items-center justify-content-center justify-content-mdbetween py-4 mb-4 border-bottom">
                <div class="container-fluid ">
                
                    <h1>
                        <a class="navbar-brand" href="<?php echo INCLUDE_PATH ?>">
                            <img width="100" src="<?php echo INCLUDE_PATH ?>images/geolibras_horizontal.png" alt="Logomarca Geolibras" />
                        </a>
                    </h1>     
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    
                    <div class=" collapse navbar-collapse " id="navbarSupportedContent">
                        <ul id="sitemaps" class="navbar-nav nav-tabs me-auto mb-2 mb-lg-0 align-items-center d-flex">
                        

                            <li class=" nav-item d-flex ">
                                <a  class="text nav-link cor-padrao-nav" aria-current="page" href="<?php echo INCLUDE_PATH ?>home">Home</a>
                            </li>

                                    <li class=" nav-item d-flex">
                                        <a  class="text nav-link cor-padrao-nav" aria-current="page" href="<?php echo INCLUDE_PATH ?>regioes">Regiões</a>
                                    </li>
                                
                                        <li class="nav-item cor-padrao-nav dropdown">
                                            <button  class=" btn px-2  nav-link cor-padrao-nav dropdown-toggle dropdown-toggle-split text" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Centro-Oeste
                                            </button>
                                            
                                            <ul class="dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                            
                                            <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/centro-oeste">Centro-Oeste</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                                <?php
                                                while ($dados = $centro_oeste->fetch()) { ?>
                                                
                                                    <li><a  class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/centro-oeste/<?php echo $dados['slug_estado']?>"><?php echo $dados['nome_estado']?></a></li>
                                                <?php } ?>
                                                
                                            </ul>
                                        </li>

                                        <li class="nav-item cor-padrao-nav dropdown">
                                            <button class="text btn px-2  nav-link cor-padrao-nav dropdown-toggle" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Nordeste
                                            </button>
                                            <ul class="dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                            <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/nordeste">Nordeste</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                                <?php
                                                while ($dados = $nordeste->fetch()) { ?>
                                                
                                                    <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/nordeste/<?php echo $dados['slug_estado']?>"><?php echo $dados['nome_estado']?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <li class="nav-item cor-padrao-nav dropdown">
                                            <button class="text btn px-2  nav-link cor-padrao-nav dropdown-toggle" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Norte
                                            </button>
                                            <ul class="dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                                <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/norte">Norte</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                    <?php
                                                    while ($dados = $norte->fetch()) { ?>
                                                    
                                                        <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/norte/<?php echo $dados['slug_estado']?>"><?php echo $dados['nome_estado']?></a></li>
                                                    <?php } ?>
                                            </ul>
                                        </li>

                                        <li class="nav-item cor-padrao-nav dropdown">
                                            <button class="text btn px-2  nav-link cor-padrao-nav dropdown-toggle" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Sudeste
                                            </button>
                                            <ul class="dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                                <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/sudeste">Sudeste</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                    <?php
                                                    while ($dados = $sudeste->fetch()) { ?>
                                                    
                                                        <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/sudeste/<?php echo $dados['slug_estado']?>"><?php echo $dados['nome_estado']?></a></li>
                                                    <?php } ?>
                                                </ul>
                                        </li>

                                        <li class="nav-item cor-padrao-nav dropdown">
                                            <button class="text btn px-2 nav-link cor-padrao-nav dropdown-toggle" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Sul
                                            </button>
                                            <ul class="dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                            <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/sul">Sul</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                                <?php
                                                while ($dados = $sul->fetch()) { ?>
                                                
                                                    <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>regioes/sul/<?php echo $dados['slug_estado']?>"><?php echo $dados['nome_estado']?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <li class="text nav-item cor-padrao-nav dropdown">
                                            <button class="text btn px-2 nav-link cor-padrao-nav dropdown-toggle"  id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Sobre
                                            </button>
                                            <ul class=" dropdown-menu bkg2-bg" aria-labelledby="navbarDropdown">
                                            <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>sobre">Sobre</a></li>
                                                <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>pesquisadores">Pesquisadores</a></li>
                                                <li><a class="text dropdown-item cor-padrao-nav" href="<?php echo INCLUDE_PATH ?>contato">Contato</a></li>
                                            </ul>
                                        </li>


                                        <div class="ps-2">
                                            <input type="radio" name="theme" id="dark" class="theme-switch" value="dark"/>
                                            <label for="dark" aria-labelledby="dark">
                                                <p id="dark" hidden>Modo de cor escuro</p>
                                                <i class="bi bi-sun">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="CurrentColor"  class="bi bi-moon-fill" viewBox="0 0 16 16">
                                                    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                                                </svg></i>
                                                </label>

                                            <input type="radio" name="theme" id="light" class="theme-switch" value="light"/>
                                            <label for="light" aria-labelledby="light">
                                                <p id="light" hidden>Modo de cor claro</p>
                                                <i class="bi bi-moon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="CurrentColor" 	 class="bi bi-sun-fill" viewBox="0 0 16 16">
                                                    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                                </svg></i>
                                            </label>
                                        </div>
                        </ul>
                        
                        
                        <div class="text">
                        <form class="text d-flex form-floating" role="search" method="GET" action="<?php INCLUDE_PATH?>pesquisa">
                            <input name="search" class="form-control me-2 bkg2-bg text" id="pesquisar" type="search" placeholder="Pesquise pelo nome do município, estado ou região"
                                aria-label="Search" aria-describedby="searchHelp" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
                                <label for="pesquisar" class="text">Pesquisar por município</label>
                            <button onclick="searchData()" class="btn btn-outline-primary cor-padrao " type="submit">
                                Buscar
                            </button>
                        </form>
                        </div>
                        
                        
                    </div>
                </div>
                
            </nav>

            
        </header>
        

        <div id="principal">
            <!-- CONTEÚDO PRINCIPAL -->

            <?php

            if(file_exists('pages/'.$url.'.php')){
                include('pages/'.$url.'.php');
            }else{
                //Podemos fazer o que quiser, pois a página não existe.
                if($url != 'pesquisadores' && $url != 'contato'){
                    $urlPar = explode('/',$url)[0];
                    if($urlPar != 'regioes'){
                    $pagina404 = true;
                    include('pages/404.php');
                    }else{
                        include('pages/regioes.php');
                    }
                }else{
                    include('pages/home.php');
                }
            }

            ?>

        <button class="btn" id="btn-top" alt="Voltar ao topo da página">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
            </svg>
        </button>


        </div>
        <footer>
            <div class="container bg-secondary mb-3">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-white mb-0">
                            <img width="100" src="<?php echo INCLUDE_PATH ?>images/logo_geolibras_invertido.png" alt="Logomarca Geolibras">
                            &copy; Copyright 2022 Geo Libras &middot; Todos os direitos reservados.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.breadcrumbs-generator.min.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
    
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.mask.js"></script>

    <script>
        $.each($('div.accordion'), function(index, element) {
            $('div.accordion-item:first').find('div.accordion-collapse').addClass('show');
        });
    </script>


    <script>

        $(window).scroll(function(){
            if ($(this).scrollTop() > 90) {
                $('#btn-top').fadeIn();
            } else {
                $('#btn-top').fadeOut();
            }
        });
        
        $('#btn-top').click(function(){
            $('html, body').animate({scrollTop : 0}, 'slow');
            return false;   
        });

    </script>

    <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    



    <?php

		if(is_array($url) && strstr($url[0],'regioes') !== false){
	?>
		<!--<script>
			$(function(){
				$('select').change(function(){
					location.href=include_path+"regioes/"+$(this).val();
				})
			})
		</script>-->
	<?php
		}
	?>

	

</body>
</html>