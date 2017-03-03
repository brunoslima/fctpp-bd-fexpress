<?php

	/**
	* 
	*/
	class PagamentoModel extends Model{
		
		private $table = "pagamento";

		public function add($numeroBoleto, $descricao, $valor, $dataVencimento, $dataEmissao, $fkGerente){

			if($fkGerente == null){
				$this->insert("INSERT INTO pagamento (numeroBoleto, descricao, valor, dataVencimento, dataEmissao, status, fkGerente) VALUES ('$numeroBoleto', '$descricao', $valor, '$dataVencimento', '$dataEmissao', 0, null)");

			}
			else $this->insert("INSERT INTO pagamento (numeroBoleto, descricao, valor, dataVencimento, dataEmissao, status, fkGerente) VALUES ('$numeroBoleto', '$descricao', $valor, '$dataVencimento', '$dataEmissao', 0, '$fkGerente')");

			
			$resultSelect = $this->select("SELECT max(idPagamento) FROM `$this->table`");
			return $resultSelect[0]['max(idPagamento)'];
			
		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");

		}

		public function listarEncomendasNaoPagas(){

			return $this->select("SELECT * FROM pagamento WHERE fkGerente is NULL and status = 0");
		}

		public function listarPagamentoEncomendas(){

			return $this->select("SELECT * FROM pagamento WHERE fkGerente is NULL");
		}

		public function listarPagamentoPedidos(){

			return $this->select("SELECT * FROM pagamento WHERE fkGerente is NOT NULL");
		}

		public function listarPagamentosDeUmaEmpresa($cnpj){

			return $this->select("
					SELECT  pagamento.idPagamento, pagamento.numeroBoleto, pagamento.descricao, 
							pagamento.valor, pagamento.dataVencimento, pagamento.dataEmissao, 
							pagamento.status
					FROM encomenda
					INNER JOIN empresa
					ON fkEmpresa = cnpj
					INNER JOIN pagamento
					ON pagamento.idPagamento = encomenda.fkPagamento
					WHERE cnpj = $cnpj
				");
		}

		public function tornarPago($fkPagamento){

			$this->update("UPDATE pagamento SET status = 1 WHERE idPagamento = $fkPagamento");

		}
		
	}
?>