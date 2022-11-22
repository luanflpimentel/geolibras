<h2 class="mb-3">Editar meu usuário</h2>

<form method="post">

	<?php
		if(isset($_POST['acao'])) {
			$nome = $_POST['nome'];
			$senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $usuario = new Usuario();

			if($nome == ''){
				Painel::alert('erro','O nome está vázio!');
			}else if($senha == ''){
				Painel::alert('erro','A senha está vázia!');
			}else{
				//Podemos cadastrar!
				if($usuario->atualizarUsuario($nome,$senha)){
                    Painel::alert('sucesso','Atualizado com sucesso!');
                }else{
                    Painel::alert('erro','Ocorreu um erro ao atualizar...');
                }
			}
		}
	?>

	<div class="mb-3">
		<label for="nome" class="form-label">Nome:</label>
		<input type="text" name="nome" required class="form-control" value="<?php echo $_SESSION['nome']; ?>">
	</div>

	
	<div class="mb-3">
		<label for="senha" class="form-label">Senha:</label>
		<input type="password" name="password" required class="form-control" value="<?php echo $_SESSION['password']; ?>">
	</div>

	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Atualizar</button>
</form>