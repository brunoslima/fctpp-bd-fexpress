<?php

	/**
	* 
	*/
	class ProdutoModel extends Model{
		
		private $table = "especproduto";

		public function add(){

			$nome = $_POST['nomeProduto'];
			$descricao = $_POST['descricaoProduto'];

			$this->insert("INSERT INTO `$this->table` (nome, descricao) VALUES ('$nome', '$descricao')");
		}

		public function listarTodos(){

			return $this->select("SELECT idEspecProduto, nome, descricao FROM `$this->table`");
		}

	}

?>