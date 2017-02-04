<?php

	/**
		* 
		*/
		class DepositoModel extends Model{
			
			private $table = "deposito";

			public function add($nome,$descricao){
				$numero = $this->query("SELECT max(numero) FROM {$this->table}");
				$numero->setFetchMode(PDO::FETCH_ASSOC);

				$numero = $numero->fetchAll()[0]['max(numero)'] + 1;				
				
				$this->query("INSERT INTO `$this->table` (numero, descricao, nome) VALUES ($numero, '$descricao','$nome');");
			}

			public function listar(){
				return $this->select("SELECT * FROM deposito");
			}
		}	

?>