<?php

	/**
		* 
		*/
		class AgricultorModel extends Model{
			
			private $table = "agricultor";

			public function add($primarykey){

				$this->insert("INSERT INTO `$this->table` (idAgricultor) VALUES ('$primarykey')");
			}
		}	

?>