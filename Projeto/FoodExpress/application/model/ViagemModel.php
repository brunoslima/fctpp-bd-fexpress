<?php

	/**
	* 
	*/
	class ViagemModel extends Model{
		
		private $table = "viagem";

		/**
		 * STATUS
		 * 0 => CONCLUIDA
		 * 1 => EM ANDAMENTO
		 */

		public function add($descricao, $veiculo, $motorista, $gerente, $status, $inicio, $fim){

			echo "INSERT INTO `viagem` VALUES (null, '$descricao', '$veiculo', '$motorista', '$gerente', $status, '$inicio', '$fim')";
			$this->insert("INSERT INTO `viagem` VALUES (null, '$descricao', '$veiculo', '$motorista', '$gerente', $status, '$inicio', '$fim')");

			return $this->select("SELECT max(idViagem) as max FROM viagem")[0]['max'];
		}

		public function listarTodos(){

			return $this->select("SELECT * FROM `$this->table`");
		}

		public function listarViagensMotorista($idMotorista){

			return $this->select("SELECT idViagem, descricao, fkVeiculo, fkGerente, status, dataInicio, dataChegada FROM `$this->table` WHERE '$idMotorista' = fkMotorista");
		}

		public function getViagem($id){

			return $this->select("SELECT * FROM viagem WHERE idViagem = $id")[0];
		}
	}
?>