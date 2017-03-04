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

		public function getEndereco($id){

			return $this->select("
				SELECT endereco.logradouro as logradouro, numero, bairro, complemento, cidade.idCidade as idCity, estados.id as idState, cidade.nome as nomeCidade, estados.nome as nomeEstado
				FROM endereco
				INNER JOIN cidade
				ON fkCidade = idCidade
				INNER JOIN estados
				ON cidade.idEstado = estados.id
				WHERE idEndereco = $id
			")[0];
		}
	}

?>