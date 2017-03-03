<?php

	/**
	* 
	*/
	class SegurancaModel extends Model{
		

		private $table = "seguranca";

		public function add($primaryKey){

			$porte = $_POST['porte'];

			$this->insert("INSERT INTO `$this->table` (idSeguranca, porteArma) VALUES ('$primaryKey', $porte)");
		}

		public function getSeguranca($id){

			return $this->select("SELECT * FROM seguranca WHERE idSeguranca = $id")[0];
		}

	}