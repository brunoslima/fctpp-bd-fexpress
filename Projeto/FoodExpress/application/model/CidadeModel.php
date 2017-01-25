<?php

	/**
	* 
	*/
	class CidadeModel extends Model{
		
		private $table = "cidade";

		public function pesquisa($id){

			$resultSelect = $this->select("SELECT idCidade, nome  FROM $this->table where idEstado = $id");
			return $resultSelect;
		}
	}

?>