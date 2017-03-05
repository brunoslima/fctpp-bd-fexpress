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

			$result = $this->select("SELECT * FROM  $this->table WHERE chaveAcesso = '$username' AND senha = '$password'");
			
		    if(!empty($result)) $_SESSION['nomeEmpresa'] = $result[0]['nome'];

		    return $result;
		    			
		}	


		public function add($cnpj, $proprietario, $nome, $chave, $senha, $primaryKeyEndereco){

			$this->query("call novaEmpresa('$cnpj', '$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco');");
			//$this->insert("INSERT INTO `$this->table` (cnpj, proprietario, nome, chaveAcesso, senha, fkEndereco) VALUES ('$cnpj', '$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco')");

		}


		public function selectAll(){

			return $this->select("SELECT cnpj, proprietario, nome FROM `$this->table`");
		}

		public function retornarNome($username, $password){

			return ("SELECT nome FROM  $this->table WHERE chaveAcesso = '$username' AND senha = '$password'");			
		}

		public function listarEmpresasComEncomenda(){

			return $this->select("SELECT nome FROM empresa WHERE cnpj IN (SELECT fkEmpresa FROM encomenda WHERE status = 0)");
		}

		public function getId($nome){

			return $this->select("SELECT cnpj FROM empresa WHERE nome = '$nome'")[0]['cnpj'];
		}

		public function getNome($cnpj){

			return $this->select("SELECT nome FROM empresa WHERE cnpj = '$cnpj'")[0]['nome'];
		}

		public function getEndereco(){

			return $this->select("SELECT logradouro, numero, bairro");
		}

		public function getEmpresa($id){

			return $this->select("SELECT * FROM empresa WHERE cnpj = $id")[0];
		}

		public function modificarEmpresa($idEmpresa, $proprietario, $nome, $chave, $senha, $primaryKeyEndereco){

			$this->query("call modificarEmpresa('$idEmpresa' ,'$proprietario', '$nome', '$chave', '$senha', '$primaryKeyEndereco');");
		}

	}

?>