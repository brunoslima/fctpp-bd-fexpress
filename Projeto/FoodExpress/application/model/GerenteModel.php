<?php

	/**
	* 
	*/
	class GerenteModel extends Model{
		
		private $table = "gerente";

		
		public function login($username, $password){


			
			$result = $this->select("SELECT * FROM  $this->table WHERE login = '$username' AND senha = '$password'");
			
			if (!empty($result)) $_SESSION['idGerente'] = $result[0]['idGerente'];

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
			$idGerente = $this->select("SELECT idGerente FROM gerente WHERE login = '$username' AND senha = '$password'");

			if (count($idGerente) > 0) {
				$idGerente = $idGerente[0]['idGerente'];
			}
			else return false;
			
			$result = $this->select("SELECT nome FROM funcionario funcionario WHERE funcionario.idfuncionario = '$idGerente'")[0]['nome'];

			return $result;
		}

		public function getNome($id){

			return $this->select("SELECT nome FROM funcionario WHERE idfuncionario = $id")[0]['nome'];
		}

		public function getGerente($id){
			return $this->select("SELECT * FROM gerente WHERE  idGerente = $id")[0];
		}

		public function modificarGerente($id, $contato, $login, $senha){

			$this->query("call modificarGerente('$id', '$contato', '$login', '$senha');");

		}
	
	}