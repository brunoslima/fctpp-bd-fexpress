<?php

	/**
	* 
	*/
	class AuxiliarLimpezaModel extends Model{
		
		private $table = "auxiliarlimpeza";


		public function add($primaryKey){

			$setor = $_POST['setor'];
			$this->insert("INSERT INTO `$this->table` (idAuxiliarLimpeza, setor) VALUES ('$primaryKey', '$setor')");
		}


	}