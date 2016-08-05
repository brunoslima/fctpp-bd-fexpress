<?php

	/**
		* 
		*/
		class OutroModel extends Model{
			
			private $table = "outro";

			public function add($primarykey){

				$this->insert("INSERT INTO `$this->table` (idOutro) VALUES ('$primarykey')");
			}
		}	

?>