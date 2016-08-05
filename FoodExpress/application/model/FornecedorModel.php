<?php

	/**
	* 
	*/
	class FornecedorModel extends Model {
		
		private $table = "fornecedor";

		public function add($primaryKeyEndereco){

			$cnpj = $_POST['cnpjFornecedor'];
			$nome = $_POST['nomeFornecedor'];
			$email = $_POST['emailFornecedor'];
			$codigo = $_POST['codigoFornecedor'];
			$area = $_POST['areaFornecedor'];
			$numero = $_POST['numeroFornecedor'];

			$resultInsert = $this->insert("INSERT INTO `$this->table` (cnpj, nome, email, codigo, area, numero, fkEndereco) VALUES ('$cnpj', '$nome', '$email', '$codigo', '$area', '$numero', '$primaryKeyEndereco')");
			return $cnpj;
		}
	}

?>