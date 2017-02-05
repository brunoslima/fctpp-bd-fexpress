<?php

	/**
		* 
		*/
		class EncomendaModel extends Model{
			
			private $table = "encomenda";

			public function listar(){

				return $this->select("SELECT idEncomenda, data, status FROM `$this->table`");
			}
		}	

?>