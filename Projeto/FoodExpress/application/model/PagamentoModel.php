<?php

	/**
	* 
	*/
	class PagamentoModel extends Model{
		
		private $table = "pagamento";

		public function add($numeroBoleto, $descricao, $valor, $dataVencimento, $dataEmissao, $fkGerente){

			$this->insert("INSERT INTO pagamento (numeroBoleto, descricao, valor, dataVencimento, dataEmissao, status, fkGerente) VALUES ('$numeroBoleto', '$descricao', $valor, '$dataVencimento', '$dataEmissao', 0, '$fkGerente')");
			
			$resultSelect = $this->select("SELECT max(idPagamento) FROM `$this->table`");
			return $resultSelect[0]['max(idPagamento)'];
			
		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");

		}
	}
?>