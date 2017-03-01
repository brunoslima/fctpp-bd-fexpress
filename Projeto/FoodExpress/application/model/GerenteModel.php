<?php

	/**
	* 
	*/
	class GerenteModel extends Model{
		
		private $table = "gerente";

		
		public function login($username, $password){


			
			$result = $this->select("SELECT * FROM  $this->table WHERE login = '$username' AND senha = '$password'");
			
			$_SESSION['idGerente'] = $result[0]['idGerente'];

			return $result;
		}


		public function add($primaryKey){

			$contato = $_POST['contato'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			$this->insert("INSERT INTO `$this->table` (email, login, senha, idGerente) VALUES ('$contato', '$login', '$senha', '$primaryKey')");
		}

		public function retornarNome($username, $password){

			//Criar procedure!!!
			$idGerente = $this->select("SELECT idGerente FROM gerente WHERE login = '$username' AND senha = '$password'")[0]['idGerente'];
			$result = $this->select("SELECT nome FROM funcionario funcionario WHERE funcionario.idfuncionario = '$idGerente'")[0]['nome'];

			return $result;
		}
	
	}