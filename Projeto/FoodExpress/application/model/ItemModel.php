<?php

	/**
	* 
	*/
	class ItemModel extends Model {
		
		private $table = "item";

		public function add ($codProduto, $cnpj, $numpedido, $quant, $preco) {

			$this->insert("INSERT INTO item VALUES ($codProduto, $cnpj, $numpedido, $quant, $preco)");
		}
	}

?>