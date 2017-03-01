<?php

	/**
		* 
		*/
		class EncomendaModel extends Model{
			
			private $table = "encomenda";

			/**
			 * status
			 * 0 => encomenda concluida
			 * 1 => encomenda em andamento
			 */

			public function listar(){

				return $this->select("SELECT idEncomenda, data, status FROM `$this->table`");
			}
		}	

?>