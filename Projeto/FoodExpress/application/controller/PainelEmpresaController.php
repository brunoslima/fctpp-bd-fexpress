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
		

		public function finalizarEncomenda(){

			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date("Y-m-d");
			$dataVencimento = date("Y-m-d",strtotime("+40 day"));

			$nomeEmpresa = $_SESSION['nomeEmpresa'];
			$modeloEmpresa = EmpresaModel();
			$idEmpresa = $modeloEmpresa->getId($nomeEmpresa);

			//Informações pagamento
			//$descricao = $_POST['descricaoPagamento'];
			$descricao = $_POST['descricao'];
			$modeloPagamento = new PagamentoModel();

			$num = rand(1, 2000000000);
			$valor = $_POST['total'];
			$idPagamento = $modeloPagamento->add($num, $descricao, $valor, $dataVencimento, $data, null);
			
			//Informações Encomenda
			$modeloEncomenda = new EncomendaModel();
			$modeloEncomenda->add($data, $idPagamento, null, $idEmpresa);

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