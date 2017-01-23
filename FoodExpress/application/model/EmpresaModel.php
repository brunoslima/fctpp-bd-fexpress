<?php

	/**
	* 
	*/
	class EmpresaModel extends Model {
		
		private $table = "empresa";

		public function add($cnpj, $proprietario, $nome, $chave, $senha, $primaryKeyEndereco){

			

			$this->insert("INSERT INTO `$this->table` (cnpj, proprietario, nome, chaveAcesso, senha, fkEndereco) VALUES ('$cnpj', '$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco')");

		}

		public function selectAll(){

			return $this->select("SELECT cnpj, proprietario, nome FROM `$this->table`");
		}
	}

?>