<?php

	/**
	* 
	*/
	class CidadeModel extends Model{
		
		private $table = "cidade";

		public function add($nome, $estado, $pais){

			$resultInsert = $this->insert("INSERT INTO `$this->table` (nome, estado, pais) VALUES ('$nome', '$estado', '$pais')");
			$resultSelect = $this->select("SELECT max(idCidade) FROM $this->table");
			return $resultSelect[0]['max(idCidade)'];
		}
	}

?>