<?php

	/**
		* 
		*/
		class DepositoModel extends Model{
			
			private $table = "deposito";

			public function add($numero, $nome,$descricao){
				$numero = $this->query("SELECT max(numero) FROM {$this->table}");
				$this->query("INSERT INTO `$this->table` (numero, descricao, nome) VALUES ('$numero', '$descricao','$nome');");
			}
		}	

?>