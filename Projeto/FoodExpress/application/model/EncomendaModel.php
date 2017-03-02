<?php

	/**
		* 
		*/
		class EncomendaModel extends Model{
			
			private $table = "encomenda";

			/**
			 * status
			 * 0 => encomenda solicitada
			 * 1 => encomenda concluida
			 */

			public function add($data, $fkPagamento, $fkViagem, $fkEmpresa){

				if($fkViagem == null){
					$teste = $this->insert("INSERT INTO `$this->table` (idEncomenda, data, status, fkPagamento, fkViagem, fkEmpresa) VALUES (null, '$data', 0, '$fkPagamento', null, '$fkEmpresa')");

				}
				else $teste = $this->insert("INSERT INTO `$this->table` (idEncomenda, data, status, fkPagamento, fkViagem, fkEmpresa) VALUES (null, '$data', 0, '$fkPagamento', '$fkViagem', '$fkEmpresa')");

			
			}

			public function listar(){

				return $this->select("SELECT idEncomenda, data, status FROM `$this->table`");
			}

			public function listarDescricao($idEmpresa){

				return $this->select("
					SELECT idEncomenda as id, data, pagamento.valor as total 
					FROM encomenda
					INNER JOIN empresa
					ON fkEmpresa = cnpj
					INNER JOIN pagamento
					ON fkPagamento = idPagamento
					WHERE encomenda.status = 0
				");
			}

			/**
			 * Altera o status da encomenda para concluido
			 * @param  Array $listaEncomendas [description]
			 * @return [type]                  [description]
			 */
			public function darBaixa($listaEncomendas, $viagem){

				foreach ($listaEncomendas as $value) {
					$id = $value['id'];
					$this->update("UPDATE encomenda SET status = 1, fkViagem = '$viagem' WHERE idEncomenda = $id");
				}

			}
		}	

?>