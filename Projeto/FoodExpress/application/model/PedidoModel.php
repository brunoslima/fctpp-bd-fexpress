<?php

	/**
	* 
	*/
	class PedidoModel extends Model{
		
		private $table = "pedido";

		/**
		 * status 
		 * 0 => em andamento
		 * 1 => concluido
		 */

		public function add($data, $fkPagamento, $fkGerente){

			$teste = $this->insert("INSERT INTO `$this->table` (dataPedido, status, fkPagamento, fkGerente) VALUES ('$data', 0, '$fkPagamento', '$fkGerente')");
			
			return $this->select("SELECT max(idPedido) as max FROM pedido");
		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");
		}

		public function darBaixa($id){

			$this->update("UPDATE pedido SET status = 1 WHERE idPedido = $id");
		}

		public function getFkPagamento($idPedido){

			return $this->select("SELECT fkPagamento FROM `$this->table` WHERE idPedido = $idPedido")[0]['fkPagamento'];
		}
	}
?>