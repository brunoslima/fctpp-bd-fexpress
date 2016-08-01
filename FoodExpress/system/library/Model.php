<?php


	abstract class Model{

		protected $connection;
		protected $tabela;

		/**
		 * Cria a conexão com o banco de dados MySQL
		 *
		 * Última modificação: 12 fev. 2016
		 */
		public function __construct(){

			if (file_exists("application/config/database.php")) require "application/config/database.php";
			else require "system/config/database.php";

			try {

				$this->connection = new PDO('mysql:host='.$database['host'].'; dbname='.$database['name'],$database['user'], $database['password']);

			} catch (Exception $e) {

				echo $e->getMessage();
				die();
			}
				
		}

		/**
		 * Realiza uma busca no banco de dados
		 * @param  String $colunas Especifica quais colunas serão obtidas as informações
		 * @param  String $where   Detalha os requisitos
		 * @return Array           Os resultados obtidos na busca
		 *
		 * Última modificação: 12 fev. 2016
		 */
		/*public function select($colunas, $where = null, $orderby = null, $limit = null, $offset){

			$query = "SELECT $colunas FROM $this->tabela";

			$query .= ($where != null ? " WHERE ".$where : "");
			$query .= ($orderby != null ? " ORDER BY ".$orderby : "");
			$query .= ($limit != null ? " LIMIT ".$limit : "");
			$query .= ($offset != null ? " OFFSET ".$offset : "");

			$result = $this->connection->query($query);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			return $result->fetchAll();
		}
		*/

		public function select($query){

			$result = $this->connection->query($query);
			if($result == null) return false;
			
			$result->setFetchMode(PDO::FETCH_ASSOC);
			return $result->fetchAll();
		}

		/**
		 * 
		 * @param  Array $dados  Dados relacionados ao item a ser inserido
		 * @return boolean       Se o método foi bem sucedido
		 *
		 * Última modificação: 12 fev. 2016
		 */
		/*public function insert($dados){

			$indices = implode(", ", array_keys($dados));
			$valores = "'".implode("','", array_values($dados))."'";

			return $this->connection->query("INSERT INTO `$this->tabela` ($indices) VALUES ($valores)");
		}*/

		public function insert($query){

			return $this->connection->query($query);
		}


		/**
		 * Realiza a atualização de dados de uma tabela
		 * @param  Array  $dados define as informacoes novas do banco de dados]
		 * @param  String $where define a condição de atualização
		 * @return               retorna uma requisição SQL de atualização
		 *
		 * Última modificação: 12 fev. 2016
		 */
		/*public function update(Array $dados, $where){

			foreach($dados as $ind => $val)
				$campos[] = "$ind = '$val'";

			$campos = implode(", ", $campos);
			return $result = $this->connection->query("UPDATE $this->tabela SET $campos WHERE $where");
		}*/

		public function update($query){

			return $this->connection->query($query);
		}

		/**
		 * Realiza a remoção de informações do banco de dados
		 * @param  String  $where define a condição
		 * @return                retorna uma requisição SQL de remoção
		 *
		 * Última modificação: 12 fev. 2016
		 */
		/*public function delete($where){

			return $this->connection->query("DELETE FROM $this->tabela WHERE $where");
		}*/

		public function delete($query){

			return $this->connection->query();
		}
	}