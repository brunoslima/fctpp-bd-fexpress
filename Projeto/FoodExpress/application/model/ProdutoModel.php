<?php

	/**
	* 
	*/
	class ProdutoModel extends Model{
		
		private $table = "produto";


		public function add ($preco, $data, $dataV, $especproduto, $deposito, $quantidadeTotal) {

			$this->insert("INSERT INTO `produto` VALUES (null, $preco, '$data', '$dataV', '$especproduto', null, $quantidadeTotal)");
		
			return $this->select("SELECT max(codProduto) as cod FROM produto")[0]['cod'];
		}

	}

?>