<?php

	/**
	* 
	*/
	class PedidoModel extends Model{
		
		private $table = "pedido";

		public function add($data, $fkPagamento, $fkGerente){

			$teste = $this->insert("INSERT INTO `$this->table` (dataPedido, status, fkPagamento, fkGerente) VALUES ('$data', 0, '$fkPagamento', '$fkGerente')");
			
			return $this->select("SELECT max(idPedido) as max FROM pedido");
		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");
		}
	}
?>