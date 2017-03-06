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

		//////////////////////////
		public function getProduto($id){
			$result = $this->select("SELECT * FROM produto WHERE fkEspecProduto = $id");
			if (count($result)>0) {
				return $result[0];
			}
			else{
				return null;
			}
		}

		public function atualiza($id, $preco, $deposito){

			$this->update("UPDATE produto SET preco = $preco, fkDeposito = $deposito WHERE fkEspecProduto = $id");

		}

		public function recalcular($espec, $novaQuant, $novoPreco){

			$produto = $this->select("SELECT * FROM produto WHERE fkEspecProduto = $espec")[0];

			$novoValor = ($novaQuant*$novoPreco+$produto['quantidadeTotal']*$produto['preco'])/($produto['quantidadeTotal']+$novaQuant);

			$quant = $novaQuant + $produto['quantidadeTotal'];
			$this->update("UPDATE produto SET quantidadeTotal = $quant, preco = $novoValor");

			return $this->select("SELECT max(codProduto) as cod FROM produto")[0]['cod'];	

		}

	}

?>