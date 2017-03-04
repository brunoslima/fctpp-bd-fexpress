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

			$this->query("
				
				call novoVeiculo('$placa', '$ano', '$modelo', '$capacidade', true);

			");
			
		}

		public function listarTodos(){

			return $this->select("SELECT idVeiculo, placa, ano, modelo, capacidade, disponivel FROM `$this->table`");
		}

		public function listarDisponiveis(){

			return $this->select("SELECT placa, capacidade FROM veiculo WHERE disponivel = 1");
		}

		public function getId($placa){

			return $this->select("SELECT idVeiculo as id FROM veiculo WHERE placa = '$placa'")[0]['id'];
		}

		public function getPlaca($id){
			return $this->select("SELECT placa FROM veiculo WHERE idVeiculo = $id")[0]['placa'];
		}

		public function tornarIndisponivel($idVeiculo){

			$this->query("call tornarVeiculoIndisponivel('$idVeiculo');");
			//$this->update("UPDATE veiculo SET disponivel = 0 WHERE idVeiculo = $idVeiculo");
		}

		public function tornarDisponivel($idVeiculo){

			$this->query("call tornarVeiculoDisponivel('$idVeiculo');");
			//$this->update("UPDATE veiculo SET disponivel = 1 WHERE idVeiculo = $idVeiculo");
		}
	}
?>