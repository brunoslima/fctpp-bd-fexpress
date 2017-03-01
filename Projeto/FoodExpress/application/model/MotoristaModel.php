<?php

	/**
	* 
	*/
	class MotoristaModel extends Model{
		
		private $table = "motorista";

		public function login($username, $password){

			return $this->select("SELECT * FROM  $this->table WHERE chaveAcesso = '$username' AND senha = '$password'");
			
		}

		public function add($primaryKey){

			$categoria = $_POST['categoria'];
			$codigo = $_POST['codigo'];
			$area = $_POST['area'];
			$numero = $_POST['numero'];
			$chaveAcesso = $_POST['chaveMotorista'];
			$senha = $_POST['senhaMotorista'];

			$this->insert("INSERT INTO `$this->table` (idMotorista, categoriaHabilitacao, codigo, area, numero, chaveAcesso, senha, disponivel) VALUES ('$primaryKey', '$categoria', '$codigo', '$area', '$numero', '$chaveAcesso', '$senha', true)");
		}

		public function retornarNome($username, $password){

			//Criar procedure!!!
			$idMotorista = $this->select("SELECT idMotorista FROM  $this->table WHERE login = '$username' AND senha = '$password'")[0]['idMotorista'];
			return $this->select("SELECT nome FROM funcionario WHERE funcionario.idfuncionario = $idMotorista")[0]['nome'];
		}

		public function listarDisponiveis(){

			
			return $this->select("SELECT nome FROM funcionario WHERE idfuncionario IN (SELECT idMotorista FROM motorista WHERE disponivel = 1)");
		}

	}

?>