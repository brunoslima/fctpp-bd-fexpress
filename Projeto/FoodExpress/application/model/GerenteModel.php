<?php

	/**
	* 
	*/
	class GerenteModel extends Model{
		
		private $table = "gerente";

		public function add($primaryKey){

			$contato = $_POST['contato'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			$this->insert("INSERT INTO `$this->table` (email, login, senha, idGerente) VALUES ('$contato', '$login', '$senha', '$primaryKey')");
		}

		/**
		 * Verifica se o usuário está cadastrado,
		 * em caso afirmativo redireciona para o 
		 * painel administrativo
		 */
		public function login(){

			$username = $_POST['username'];
			$password = $_POST['password'];

			$result = $this->select("SELECT * FROM  $this->table WHERE login = '$username' AND senha = '$password'");
			
			if($result != false){
				$data['resposta'] = true;

				session_start();
				$_SESSION['user'] = $username;
				$_SESSION['type'] = "gerente";
			}
			else{

				$data['resposta'] =	false;
			}

			echo json_encode($data);
		}	
	}