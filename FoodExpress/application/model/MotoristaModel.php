<?php

	/**
	* 
	*/
	class MotoristaModel extends Model{
		
		private $table = "motorista";

		public function add($primaryKey){

			$categoria = $_POST['categoria'];
			$codigo = $_POST['codigo'];
			$area = $_POST['area'];
			$numero = $_POST['numero'];

			$this->insert("INSERT INTO `$this->table` (idMotorista, categoriaHabilitacao, codigo, area, numero, disponivel) VALUES ('$primaryKey', '$categoria', '$codigo', '$area', '$numero', true)");
		}
	}

?>