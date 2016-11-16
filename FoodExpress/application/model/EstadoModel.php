<?php

	/**
	* 
	*/
	class EstadoModel extends Model{
		
		private $table = "estados";

		public function pesquisa(){

			$resultSelect = $this->select("SELECT id, nome  FROM $this->table");
			return $resultSelect;

		}
	}

?>