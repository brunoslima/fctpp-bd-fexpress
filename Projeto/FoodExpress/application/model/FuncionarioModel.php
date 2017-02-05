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

		public function listar(){

			$func['limpeza'] = $this->select("SELECT * FROM funcionario, auxiliarlimpeza WHERE idfuncionario = idAuxiliarLimpeza");
			$func['gerente'] = $this->select("SELECT * FROM funcionario, gerente WHERE idfuncionario = idGerente");
			$func['motorista'] = $this->select("SELECT * FROM funcionario, motorista WHERE idfuncionario = idMotorista");
			$func['seguranca'] = $this->select("SELECT * FROM funcionario, seguranca WHERE idfuncionario = idSeguranca");
			return $func;
		}

		public function buscaIDGerente($nome){

			//Seria uma boa fazer uma procedure para isto com parametros in, out e tals....
			return $this->select("SELECT idGerente FROM `$this->tabela`, gerente WHERE (idfuncionario.`$this->tabela` = idGerente and '$nome' = nome.`$this->tabela`)");
		}

	}