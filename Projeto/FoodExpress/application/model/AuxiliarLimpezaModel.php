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

		public function getAuxiliar($id){
			return $this->select("SELECT * FROM auxiliarlimpeza WHERE idAuxiliarLimpeza = $id")[0];
		}

		public function modificarAuxiliarLimpeza($idAuxiliarLimpeza, $setor){

			$this->query("call modificarAuxiliarLimpeza('$idAuxiliarLimpeza', '$setor');");

		}

	}