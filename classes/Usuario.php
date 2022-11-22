<?php
	
	class Usuario{

		public static function listarUsuarios(){
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function selectAll($tabela,$start = null,$end = null){
			if($start == null && $end == null)
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC");
			else
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $start,$end");
	
			$sql->execute();

			
			return $sql->fetchAll();

		}

		public function atualizarUsuario($nome,$senha){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?,password = ? WHERE user = ?");
			if($sql->execute(array($nome,$senha,$_SESSION['user']))){
				return true;
			}else{
				return false;
			}
		}

		public static function userExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

		public static function cadastrarUsuario($user,$senha,$nome,$cargo,$order_id){
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($user,$senha,$nome,$cargo,$order_id));
			$lastId = MySql::conectar()->lastInsertId();
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET order_id = ? WHERE id = $lastId");
			$sql->execute(array($lastId));
		}

	}

?>