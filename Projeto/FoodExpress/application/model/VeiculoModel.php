<?php

	/**
	* 
	*/
	class VeiculoModel extends Model{
		
		private $table = "veiculo";

		public function add(){

			$placa = $_POST['placaVeiculo'];
			$ano = $_POST['anoVeiculo'];
			$modelo = $_POST['modeloVeiculo'];
			$capacidade = $_POST['capacidadeVeiculo'];

			$this->insert("INSERT INTO `$this->table` (placa, ano, modelo, capacidade, disponivel) VALUES ('$placa', '$ano', '$modelo', '$capacidade', true)");
		}

		public function listarTodos(){

			return $this->select("SELECT idVeiculo, placa, ano, modelo, capacidade, disponivel FROM `$this->table`");
		}
	}
?>