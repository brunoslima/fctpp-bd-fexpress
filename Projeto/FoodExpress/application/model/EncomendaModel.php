<?php

	/**
		* 
		*/
		class EncomendaModel extends Model{
			
			private $table = "encomenda";

			/**
			 * status
			 * 0 => encomenda concluida
			 * 1 => encomenda em andamento
			 */

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
					WHERE encomenda.status = 1
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
					$this->update("UPDATE encomenda SET status = 0, fkViagem = '$viagem' WHERE idEncomenda = $id");
				}

			}
		}	

?>