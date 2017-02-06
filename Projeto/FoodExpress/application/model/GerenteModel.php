<?php

	/**
	* 
	*/
	class GerenteModel extends Model{
		
		private $table = "gerente";

		
		public function login($username, $password){

			return $this->select("SELECT * FROM  $this->table WHERE login = '$username' AND senha = '$password'");
			
		}


		public function add($primaryKey){

			$contato = $_POST['contato'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			$this->insert("INSERT INTO `$this->table` (email, login, senha, idGerente) VALUES ('$contato', '$login', '$senha', '$primaryKey')");
		}

		public function retornarNome($username, $password){

			//Criar procedure!!!
			$idGerente = ("SELECT idGerente FROM  $this->table WHERE login = '$username' AND senha = '$password'");
			return ("SELECT nome FROM funcionario, $this->table WHERE '$idGerente' = funcionario.idfuncionario");
		}
	
	}