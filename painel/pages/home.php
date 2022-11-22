<?php

    $usuariosOnline = Painel::listarUsuariosOnline();

	$pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
	$pegarVisitasTotais->execute();

	$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

	$pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$pegarVisitasHoje->execute(array(date('Y-m-d')));

	$pegarVisitasHoje = $pegarVisitasHoje->rowCount();

$contadorRegioes = MySql::conectar()->prepare("SELECT * FROM `tb_site.regioes`");
$contadorRegioes->execute();
$contadorRegioes = $contadorRegioes->rowCount();

$contadorEstados = MySql::conectar()->prepare("SELECT * FROM `tb_site.estados`");
$contadorEstados->execute();
$contadorEstados = $contadorEstados->rowCount();

$contadorMunicipios = MySql::conectar()->prepare("SELECT * FROM `tb_site.municipios`");
$contadorMunicipios->execute();
$contadorMunicipios = $contadorMunicipios->rowCount();

$contadorPesquisadores = MySql::conectar()->prepare("SELECT * FROM `tb_site.pesquisadores`");
$contadorPesquisadores->execute();
$contadorPesquisadores = $contadorPesquisadores->rowCount();

$contadorUsuariosAdmin = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
$contadorUsuariosAdmin->execute();
$contadorUsuariosAdmin = $contadorUsuariosAdmin->rowCount();
?>

<h2 class="mb-3">Dashboard</h2>

<div class="row">
    <div class="col-md-4 ms-sm-auto col-lg-4 ">
        <div class="card mb-3">
            <h5 class="card-header cor-padrao">Usuários</h5>
            <div class="card-body">
                <h5 class="card-title">Usuários online</h5>
                <p class="card-text"><?php echo count($usuariosOnline); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 ms-sm-auto col-lg-4 ">
        <div class="card mb-3">
            <h5 class="card-header cor-padrao">Visitas</h5>
            <div class="card-body">
                <h5 class="card-title">Total de visitas</h5>
                <p class="card-text"><?php echo $pegarVisitasTotais; ?></p>
            </div>
        </div>

    </div>

    <div class="col-md-4 ms-sm-auto col-lg-4 ">
        <div class="card mb-3">
            <h5 class="card-header cor-padrao">Visitas</h5>
            <div class="card-body">
                <h5 class="card-title">Visitas Hoje</h5>
                <p class="card-text"><?php echo $pegarVisitasHoje; ?></p>
            </div>
        </div>

    </div>
</div>


<div class="card mb-3">
    <h5 class="card-header cor-padrao">Regiões</h5>
    <div class="card-body">
        <h5 class="card-title">Regiões cadastradas</h5>
        <p class="card-text">
            <?php echo $contadorRegioes; ?>
        </p>
    </div>
</div>

<div class="card mb-3">
    <h5 class="card-header cor-padrao">Estados</h5>
    <div class="card-body">
        <h5 class="card-title">Estados cadastrados</h5>
        <p class="card-text">
            <?php echo $contadorEstados; ?>
        </p>
    </div>
</div>

<div class="card mb-3">
    <h5 class="card-header cor-padrao">Municípios</h5>
    <div class="card-body">
        <h5 class="card-title">Municipios cadastrados</h5>
        <p class="card-text">
            <?php echo $contadorMunicipios; ?>
        </p>
    </div>
</div>

<div class="card mb-3">
    <h5 class="card-header cor-padrao">Pesquisadores</h5>
    <div class="card-body">
        <h5 class="card-title">Pesquisadores cadastrados</h5>
        <p class="card-text">
            <?php echo $contadorPesquisadores; ?>
        </p>
    </div>
</div>

<div class="card mb-3">
    <h5 class="card-header cor-padrao">Usuários do painel</h5>
    <div class="card-body">
        <h5 class="card-title">Usuários cadastrados</h5>
        <p class="card-text">
            <?php echo $contadorUsuariosAdmin; ?>
        </p>
    </div>
</div>
