<?php

	/**
	* 
	*/
	class FuncionarioModel extends Model{
		
		private $table = "funcionario";

		public function add(){

			$nome = $_POST['nome'];
			$salario = $_POST['salario'];
			$dataN = $_POST['dataNascimento'];
			$dataC = $_POST['dataContratacao'];

			$resultInsert = $this->insert("INSERT INTO `$this->table` (nome, salario, dataContratacao, dataNascimento) VALUES ('$nome', '$salario', '$dataC', '$dataN')");
			$resultSelect = $this->select("SELECT max(idfuncionario) FROM $this->table");
			return $resultSelect[0]['max(idfuncionario)'];
		}
	}