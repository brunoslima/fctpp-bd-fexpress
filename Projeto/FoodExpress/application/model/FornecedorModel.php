<?php

	/**
	* 
	*/
	class FornecedorModel extends Model {
		
		private $table = "fornecedor";

		public function add($primaryKeyEndereco){

			$cnpj = $_POST['cnpjFornecedor'];
			$nome = $_POST['nomeFornecedor'];
			$email = $_POST['emailFornecedor'];
			$codigo = $_POST['codigoFornecedor'];
			$area = $_POST['areaFornecedor'];
			$numero = $_POST['numeroFornecedor'];

			$this->query("call novoFornecedor('$cnpj', '$nome', '$email', '$codigo', '$area', '$numero', '$primaryKeyEndereco');");
			//$resultInsert = $this->insert("INSERT INTO `$this->table` (cnpj, nome, email, codigo, area, numero, fkEndereco) VALUES ('$cnpj', '$nome', '$email', '$codigo', '$area', '$numero', '$primaryKeyEndereco')");
			return $cnpj;
		}

		public function listar(){

			return $this->select("SELECT cnpj, nome, email, codigo, area, numero FROM `$this->table`");
		}

		/////////////////////////////
		public function listarTodos(){

			$func['agricultor'] = $this->select("SELECT * FROM fornecedor, agricultor WHERE cnpj = idAgricultor");
			$func['fabrica'] = $this->select("SELECT * FROM fornecedor, fabrica WHERE cnpj = idFabrica");
			$func['outro'] = $this->select("SELECT * FROM fornecedor, outro WHERE cnpj = idOutro");
			return $func;
		}

		public function getFornecedor($id){

			return $this->select("SELECT * FROM fornecedor WHERE cnpj = $id")[0];
		}

		public function modificarFornecedor($cnpj, $nome, $email, $codigo, $area, $numero, $primaryKeyEndereco){

			$this->query("call modificarFornecedor('$cnpj', '$nome', '$email', '$codigo', '$area', '$numero', '$primaryKeyEndereco');");
		}
	}

?>