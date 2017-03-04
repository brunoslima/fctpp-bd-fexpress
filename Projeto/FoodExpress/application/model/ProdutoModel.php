<?php

	/**
	* 
	*/
	class ProdutoModel extends Model{
		
		private $table = "produto";


		public function add ($preco, $data, $dataV, $especproduto, $deposito, $quantidadeTotal) {

			return $this->select("
				
				call novoProduto($preco, '$data', '$dataV', '$especproduto', $quantidadeTotal);

			")[0]['cod'];

			//$this->insert("INSERT INTO `produto` VALUES (null, $preco, '$data', '$dataV', '$especproduto', null, $quantidadeTotal)");
		
			//return $this->select("SELECT max(codProduto) as cod FROM produto")[0]['cod'];
		}

		public function darBaixa($idPedido, $idDeposito){

			$this->query("call vincularProdutoDeposito('$idPedido','$idDeposito')");

			/*return $this->update("
				
				UPDATE produto SET fkDeposito = '$idDeposito'
				WHERE codProduto IN (
					SELECT codProduto
					FROM item
					WHERE num_pedido = '$idPedido'
				)
			");*/
		}

	}

?>