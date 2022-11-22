<?php
	verificaPermissaoPagina(2);
?>

<h2 class="mb-3">Adicionar novo usuário</h2>

<form method="post" >

	<?php
		if(isset($_POST['acao'])) {
			$nome = $_POST['nome'];
			$login = $_POST['login'];
			$senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$cargo = $_POST['cargo'];
			$order_id = $_POST['order_id'];

			if($nome == ''){
				Painel::alert('erro','O nome está vázio!');
			}else if($login == ''){
				Painel::alert('erro','O usuário está vázio!');
			}else if($senha == ''){
				Painel::alert('erro','A senha está vázia!');
			}else if($cargo == ''){
				Painel::alert('erro','O cargo precisa estar selecionado!');
			}else{
				//Podemos cadastrar!
				if($cargo >= $_SESSION['cargo']){
					Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
				}else if(Usuario::userExists($login)){
					Painel::alert('erro','O usuário já existe, escolha outro por favor!');
				}else{
					//Apenas cadastrar no banco de dados!
					$usuario = new Usuario();
					
					$usuario->cadastrarUsuario($login,$senha,$nome,$cargo,$order_id);
					Painel::alert('sucesso','O cadastro do usuário '.$login.' foi feito com sucesso!');
				}
			}
		}
	?>

	<div class="mb-3">
		<label for="nome" class="form-label">Nome:</label>
		<input type="text" name="nome" required class="form-control">
	</div>

	<div class="mb-3">
		<label for="usuario" class="form-label">Usuário:</label>
		<input type="text" name="login" required class="form-control">
	</div>

	<div class="mb-3">
		<label for="senha" class="form-label">Senha:</label>
		<input type="password" name="password" required class="form-control">
	</div>

	<div class="mb-3">
		<label for="cargo" class="form-label">Cargo:</label>
		<select name="cargo" required class="form-select" >
			<?php
				foreach (Painel::$cargos as $key => $value) {
					if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
				}
			?>
		</select>
	</div>

	<input type="hidden" name="order_id" value="0">
	<input type="hidden" name="nome_tabela" value="tb_admin.usuarios" /> 

	<button type="submit" name="acao" class="btn btn-primary cor-padrao">Cadastrar</button>
</form>