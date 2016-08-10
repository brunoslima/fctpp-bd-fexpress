<?php

	/**
	* 
	*/
	class EmpresaModel extends Model {
		
		private $table = "empresa";

		public function add($primaryKeyEndereco){

			$cnpj = $_POST['cnpjEmpresa'];
			$proprietario = $_POST['proprietarioEmpresa'];
			$nome = $_POST['nomeEmpresa'];
			$chave = $_POST['chaveEmpresa'];
			$senha = $_POST['senhaEmpresa'];

			$this->insert("INSERT INTO `$this->table` (cnpj, proprietario, nome, chaveAcesso, senha, fkEndereco) VALUES ('$cnpj', '$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco')");

		}
	}

?>