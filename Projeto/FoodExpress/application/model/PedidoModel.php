<?php

	/**
	* 
	*/
	class PedidoModel extends Model{
		
		private $table = "pedido";

		public function add($data, $fkPagamento, $fkGerente){

			$this->insert("INSERT INTO `$this->table` (dataPedido, status, fkPagamento, fkGerente) VALUES ('$data', 0, '$fkPagamento', '$fkGerente')");
			
			return $this->select("SELECT LAST_INSERT_ID() INTO @idPedido");

		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");
		}
	}
?>