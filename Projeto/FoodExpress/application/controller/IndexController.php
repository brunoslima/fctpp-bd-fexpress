<?php

	/**
	* 
	*/
	class IndexController extends Controller{
		
		/**
		 * Redireciona para a view Index
		 */
		public function index(){

			$this->view('index');
		}
		
		/**
		 * Verifica o login de usuário no model Index
		 */
		public function login(){
			
			session_start();
			$_SESSION['autenticado'] = false;
			$data['resposta'] =	false;
			$data['tipoUsuario'] = "";

			$username = $_POST['username'];
			$password = $_POST['password'];
			$data = array();

			if($_SESSION['autenticado'] == false){

				$modeloGerente = new GerenteModel();
				$result = $modeloGerente->login($username, $password);
				$nome = $modeloGerente->retornarNome($username, $password);
				$this->autenticar($result, $data, "gerente", $username, $nome);

			}

			if($_SESSION['autenticado'] == false){
				
				$modeloEmpresa = new EmpresaModel();
				$result = $modeloEmpresa->login($username, $password);
				$nome = $modeloEmpresa->retornarNome($username, $password);
				$this->autenticar($result, $data, "empresa", $username, $nome);
			}

			if($_SESSION['autenticado'] == false){
				
				$modeloMotorista = new MotoristaModel();
				$result = $modeloMotorista->login($username, $password);
				$nome = $modeloMotorista->retornarNome($username, $password);
				$this->autenticar($result, $data, "motorista", $username, $nome);

			}

			echo json_encode($data);

		}

		private function autenticar($result, &$data, $tipoUsuario, $username, $nome){

			
			if($result != false && count($result) == 1){
				
				$data['resposta'] = true;
				$data['tipoUsuario'] = $tipoUsuario;
				$_SESSION['user'] = $username;
				$_SESSION['type'] = $tipoUsuario;
				$_SESSION['autenticado'] = true;
				$_SESSION['nomeUsuario'] = $nome;
			}
			else{

				$data['resposta'] =	false;
				$data['tipoUsuario'] = "";
				$_SESSION['autenticado'] = false;
			}

		}

	}