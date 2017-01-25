<?php

	/**
	* 
	*/
	class SegurancaModel extends Model{
		

		private $table = "seguranca";

		public function add($primaryKey){

			$porte = $_POST['porte'];
			echo "aaaa".$porte;
			$this->insert("INSERT INTO `$this->table` (idSeguranca, porteArma) VALUES ('$primaryKey', $porte)");
		}

	}