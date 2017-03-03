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

			public function listarTodos(){

				return $this->select("SELECT * FROM `$this->table`");
			}

			public function listarEncomendasDaEmpresa($cnpj){

				return $this->select("SELECT idEncomenda, data, status FROM `$this->table` WHERE fkEmpresa = $cnpj");
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

			public function getEmpresaEndereco($id){

				return $this->select("
					SELECT empresa.nome as empresa, logradouro, numero, bairro, complemento, cidade.nome as cidade, estados.nome as estado
					FROM empresa 
					INNER JOIN endereco
					ON fkEndereco = idEndereco
					INNER JOIN cidade
					ON fkCidade = idCidade
					INNER JOIN estados
					ON idEstado = estados.id
					WHERE cnpj IN (SELECT fkEmpresa FROM encomenda WHERE fkViagem = $id)
				");
			}

			public function getEmpresaPagamento($fkPagamento){

				return $this->select("SELECT fkEmpresa FROM encomenda WHERE fkPagamento = $fkPagamento")[0]['fkEmpresa'];
			}

		}	

?>