<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geolibras - Painel de Controle</title>
    <link href="<?php echo INCLUDE_PATH ?>estilo/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/sidebars.css" rel="stylesheet">

  </head>
  <body>




    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="<?php echo INCLUDE_PATH_PAINEL ?>home"><img src="<?php echo INCLUDE_PATH ?>images/logo_geolibras_horiz.jpg" alt=""  height="40"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
    
  <h5 class="w-100 text-center">Painel de controle</h5>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap ">
            
        <a class="nav-link px-3" href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    Sair 
                </a>
        </div>
    </div>
    </header>

    

    <div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
            <ul id="sitemaps" class="nav flex-column">
            <li class="nav-item mt-2">
                <a <?php selecionadoNav('home'); ?> class="nav-link " aria-current="page" href="<?php echo INCLUDE_PATH_PAINEL ?>home">
                
                Home
                </a>
                <ul class="padding-ul">

                <li class="nav-item">
                        <a <?php selecionadoNav('sobre'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>sobre">
                        
                        Sobre
                        </a>
                </li>
                    

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted text-uppercase">
                        <span>Regiões</span>
                    </h6>

                    <li class="nav-item">
                        <a <?php selecionadoNav('gerenciar-regioes'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-regioes">
                        
                        Gerenciar regiões
                        </a>

                        <ul class="padding-ul" style="display:none;">
                            <li class="nav-item">
                            <a <?php selecionadoNav('gerenciar-regioes'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-regiao">
                            
                            Editar Região
                            </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a <?php selecionadoNav('cadastrar-regiao'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-regiao">
                        
                        Cadastrar região
                        </a>
                    </li>

                    

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted text-uppercase">
                        <span>Estados</span>
                    </h6>

                    <li class="nav-item">
                        <a <?php selecionadoNav('gerenciar-estados'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-estados">
                        
                        Gerenciar estados
                        </a>

                        <ul class="padding-ul" style="display:none;">
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-estado">
                            
                            Editar estado
                            </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a <?php selecionadoNav('cadastrar-estado'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-estado">
                        Cadastrar estado
                        </a>
                    </li>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted text-uppercase">
                        <span>Municípios</span>
                    </h6>

                    <li class="nav-item">
                        <a <?php selecionadoNav('gerenciar-municipios'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-municipios">
                        
                        Gerenciar municípios
                        </a>

                        <ul class="padding-ul" style="display:none;">
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-municipio">
                            
                            Editar município
                            </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a <?php selecionadoNav('cadastrar-municipio'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-municipio">
                        Cadastrar município
                        </a>
                    </li>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted text-uppercase">
                        <span>Pesquisadores</span>
                    </h6>

                    <li class="nav-item">
                        <a <?php selecionadoNav('gerenciar-pesquisadores'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-pesquisadores">
                        
                        Gerenciar pesquisadores
                        </a>

                        <ul class="padding-ul" style="display:none;">
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-pesquisador">
                            
                            Editar pesquisador
                            </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a <?php selecionadoNav('cadastrar-pesquisador'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-pesquisador">
                        Cadastrar pesquisador
                        </a>
                    </li>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted text-uppercase">
                        <span>Usuários</span>
                    </h6>

                    <li class="nav-item" >
                        <a <?php selecionadoNav('gerenciar-usuarios'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-usuarios">
                        
                        Gerenciar usuários
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a <?php selecionadoNav('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">
                        
                        Adicionar usuário
                        </a>
                    </li>

                    <li class="nav-item" >
                        <a <?php selecionadoNav('editar-meu-usuario'); ?> class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-meu-usuario">
                        
                        Editar meu usuário
                        </a>
                    </li>
                </ul>
                
            </li>

            </ul>
        </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="align-items-center pt-3 pb-2 mb-3">
        
            <section class="bread">
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                    <ul id="breadcrumbs" class="breadcrumb ">
                    </ul>
                </nav>
            </section>  
            
            <div>
            
            <?php Painel::carregarPagina(); ?>
            </div>
        </div>
        </main>

        
    </div>
    </div>

    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.breadcrumbs-generator.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/pt-BR.js"></script>
    <script src="https://cdn.tiny.cloud/1/8km33hc4kf4oqy18ajjd1jerrdttyfe0ssnpj7fpl9098abl/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
      selector: '.tinymce',
      plugins: 'image autolink lists  media table',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      height:300,
      entity_encoding:'raw'
    });
  </script>
    
  </body>
</html>