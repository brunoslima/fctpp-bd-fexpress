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

			$this->insert("INSERT INTO `viagem` VALUES (null, '$descricao', '$veiculo', '$motorista', '$gerente', $status, '$inicio', '$fim')");

			return $this->select("SELECT max(idViagem) as max FROM viagem")[0]['max'];
		}
	}
?>