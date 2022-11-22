<?php
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
		$sql->execute(array($user));

    if($sql->rowCount() == 1){
      $info = $sql->fetch();
      if(password_verify($password, $info['password'])){
				
				$_SESSION['login'] = true;
				$_SESSION['user'] = $user;
				$_SESSION['password'] = $password;
				$_SESSION['cargo'] = $info['cargo'];
				$_SESSION['nome'] = $info['nome'];
				Painel::redirect(INCLUDE_PATH_PAINEL);
			
		}
    }
    
	}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geolibras</title>
    <link href="<?php echo INCLUDE_PATH ?>estilo/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/signin.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/style.css" rel="stylesheet">
    
  </head>
  <body class="text-center">

    <div class="container form-signin">
      <?php
        if(isset($_POST['acao'])){

          $user = $_POST['user'];
          $password = $_POST['password'];
          $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
          $sql->execute(array($user));

          if($sql->rowCount() == 1) {
            $info = $sql->fetch();
            if(password_verify($password, $info['password'])){
            
              //Logamos com sucesso.
              $_SESSION['login'] = true;
              $_SESSION['user'] = $user;
              $_SESSION['password'] = $password;
              $_SESSION['cargo'] = $info['cargo'];
              $_SESSION['nome'] = $info['nome'];
              if(isset($_POST['lembrar'])){
                setcookie('lembrar',true,time()+(60*60*24),'/');
                setcookie('user',$user,time()+(60*60*24),'/');
                setcookie('password',$password,time()+(60*60*24),'/');
              }
              Painel::redirect(INCLUDE_PATH_PAINEL);
            }else{
              //Falhou
              Painel::alert('erro','Usuário ou senha incorretos.');
              
            }
          } else {
            Painel::alert('erro','Usuário não encontrado.');
          }
          
        }
      ?>
        <form method="post">
            <img class="mb-4" src="<?php echo INCLUDE_PATH ?>images/logo_geolibras_horiz.jpg" alt=""  height="81">
            
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating">
                <input  required type="text" name="user" class="form-control" id="floatingInput" placeholder="Usuário">
                <label for="floatingInput">Usuário</label>
            </div>
            <div class="form-floating">
                <input required type="password" name="password" class="form-control" id="floatingPassword" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
            </div>

            <div class="checkbox mb-3">
                
                <input type="checkbox" name="lembrar" value="lembrar" />
                <label >Mantenha-me conectado</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary cor-padrao" name="acao" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">© Geolibras</p>
        </form>
    </div>
  
    <script src="<?php echo INCLUDE_PATH ?>js/bootstrap.bundle.min.js"></script>
  </body>
</html>