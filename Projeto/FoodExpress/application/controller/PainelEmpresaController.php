<?php
	
	/**
	* 
	*/
	class PainelEmpresaController extends Controller{
		
		/**
		 * Constroi o controller verificando se há uma sessão
		 * de usuário criada, sendo esta requerida para acesso
		 */
		function __construct(){

			session_start();
			session_cache_expire(1800);
			if(!(isset($_SESSION) && strlen($_SESSION['user']) > 3)){
				throw new Exception("Sessão inexistente", 1);
			}
		}
		

		public function cadastrarEncomenda(){

			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d/m/Y');
			$dataVencimento = date('d/m/Y', strtotime($data.' +2 days'));

		}


		/**
		 * Redireciona para a view Painel
		 */
		public function index(){

			$this->view("painelEmpresa");
		}

		/**
		 * Encerra uma sessão de usuário
		 */
		public function logout(){

			session_destroy();
		}
		
	}