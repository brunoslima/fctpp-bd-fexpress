<?php

	/**
	* 
	*/
	class EspecProdutoModel extends Model {
		
		private $table = "especproduto";

		public function listar(){

			return $this->select("SELECT nome, descricao FROM {$this->table};");
		}
	}

?>