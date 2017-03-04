<?php

	/**
	* 
	*/
	class EspecProdutoModel extends Model {
		
		private $table = "especproduto";

		public function add(){

			$nome = $_POST['nomeProduto'];
			$descricao = $_POST['descricaoProduto'];

			$this->insert("INSERT INTO `$this->table` (nome, descricao) VALUES ('$nome', '$descricao')");

			$result = $this->select("SELECT max(idEspecProduto) as max FROM `$this->table`");
			$id = $result[0]['max'];
			$idFornecedor = $_POST['idFornecedor'];

			$this->insert("INSERT INTO produtofornecedor VALUES ('$id','$idFornecedor')");
		}

		public function listar(){

			return $this->select("SELECT nome, descricao FROM {$this->table}");
		}

		public function listarTodos(){

			return $this->select("SELECT idEspecProduto, nome, descricao FROM `$this->table`");
		}

		public function listarProdutos($nome){

			$id = $this->select("SELECT cnpj FROM fornecedor WHERE nome = '$nome'")[0]['cnpj'];
			$listaProdutos = $this->select("SELECT fk_espec_produto as cod FROM produtofornecedor WHERE fk_cnpj = $id");
			$_SESSION['idFornecedor'] = $id;
			$lista = array();
			foreach ($listaProdutos as $value) {
				array_push($lista, $value['cod']);
			}

			$a = '('.implode(",", $lista).')';

			return $this->query("SELECT idEspecProduto as cod, nome FROM especproduto WHERE idEspecProduto IN $a");
		}

		public function listarPorNomeEspec($nome) {
			
			return $this->select("SELECT idEspecProduto FROM especproduto WHERE nome = '$nome'")[0]['idEspecProduto'];
		}

		public function retornarValorProduto($nome){

			return $this->select("SELECT produto.preco FROM produto, especproduto WHERE produto.fkEspecProduto = especproduto.idEspecProduto and especproduto.nome = '$nome'")[0]['preco'];
		}
		
		///////////////////////
		public function getEspecProduto($id){

			return $this->select("SELECT * FROM especproduto WHERE idEspecProduto = $id")[0];
		}
			
	}

?>