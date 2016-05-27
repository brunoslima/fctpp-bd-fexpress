<?php



	class UsuarioModel extends Model{
		
		protected $tabela = "usuario";

		public function add(){

			$dados = array(
				"id" => null,
				"nome" => "Eymar",
				"email" => "yasmat@gmail.com",
				"senha" => "açdkakjekjeijwkj",
				"categoria" => 2
			);

			var_dump($this->insert($dados));
		}

		public function search(){

			$a = $this->select("email, senha", null, "email", 10, 1);

			var_dump($a);
		}

		public function atualizar(){

			$dados = array(
			
				'senha' => 'justEymar'
			);

			var_dump($this->update($dados, 'id = 3'));
		}

		public function remover(){

			var_dump($this->delete('id = 4'));
		}
	}