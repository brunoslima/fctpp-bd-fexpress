<?php

	/**
		* 
		*/
		class FabricaModel extends Model{
			
			private $table = "fabrica";

			public function add($primarykey){

				$this->insert("INSERT INTO `$this->table` (idFabrica) VALUES ('$primarykey')");
			}
		}	

?>