<?php

	/**
	* 
	*/
	class EmpresaModel extends Model {
		
		private $table = "empresa";

		/**
		 * Verifica se a empresa está cadastrado,
		 * em caso afirmativo redireciona para o 
		 * painel da empresa
		 */
		public function login($username, $password){

			return $this->select("SELECT * FROM  $this->table WHERE chaveAcesso = '$username' AND senha = '$password'");
			
		}	


		public function add($cnpj, $proprietario, $nome, $chave, $senha, $primaryKeyEndereco){

			$this->insert("INSERT INTO `$this->table` (cnpj, proprietario, nome, chaveAcesso, senha, fkEndereco) VALUES ('$cnpj', '$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco')");

		}


		public function selectAll(){

			return $this->select("SELECT cnpj, proprietario, nome FROM `$this->table`");
		}

		public function retornarNome($username, $password){

			return ("SELECT nome FROM  $this->table WHERE chaveAcesso = '$username' AND senha = '$password'");			
		}

		public function listarEmpresasComEncomenda(){

			return $this->select("SELECT nome FROM empresa WHERE cnpj IN (SELECT fkEmpresa FROM encomenda WHERE status <> 0)");
		}
	}

?>