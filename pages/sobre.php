<?php 

    $sobre = MySql::conectar()->prepare("SELECT * FROM `tb_site.sobre`");
    $sobre->execute();
    $sobre = $sobre->fetch();



?>

<div class="container">
    <div class="row">
    <h1 class="text text-center mb-3">Sobre o projeto</h1>
    </div>
    
    <div class="row my-3">
        <div class="col text">
            
            <?php echo $sobre['sobre']; ?>
            
        </div>
    </div>
    
    
</div>