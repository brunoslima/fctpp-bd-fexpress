<?php

	/**
		* 
		*/
		class EncomendaModel extends Model{
			
			private $table = "encomenda";

			public function listar(){

				return $this->query("SELECT idEncomenda, data, status FROM {$this->table}");
			}
		}	

?>