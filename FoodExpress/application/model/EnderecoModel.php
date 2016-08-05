<?php

	/**
	* 
	*/
	class EnderecoModel extends Model{
		
		private $table = "endereco";

		public function add($logradouro, $numeroEndereco, $bairro, $complemento, $primaryKeyCidade){

			$resultInsert = $this->insert("INSERT INTO `$this->table` (logradouro, numero, bairro, complemento, fkCidade) VALUES ('$logradouro', '$numeroEndereco', '$bairro', '$complemento', '$primaryKeyCidade')");
			$resultSelect = $this->select("SELECT max(idEndereco) FROM $this->table");
			return $resultSelect[0]['max(idEndereco)'];
		}
	}

?>