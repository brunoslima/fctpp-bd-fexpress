<?php

	/**
		* 
		*/
		class DepositoModel extends Model{
			
			private $table = "deposito";

			public function add($nome,$descricao){			
				
				$this->insert("INSERT INTO `$this->table` (numero, descricao, nome) VALUES (null, '$descricao','$nome');");
			}

			public function listar(){
				return $this->select("SELECT * FROM deposito");
			}
		}	

?>