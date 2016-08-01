<?php


	class System{

		private $param;
		private $controller;
		private $action;
		private $application;

		/**
		 * Construtor da classe System
		 * @param String $address Recebe a url da barra de navegação
		 *
		 * Última modificação: 12 fev. 2016
		 */
		public function __construct($address = null) {
			
			$this->param = array_filter(explode("/", $address));
			$this->controller = (count($this->param) > 0 ? $this->param[0]."Controller" : "indexController");
			$this->action = (count($this->param) > 1 ? $this->param[1] : "index");
		}

		/**
		 * Inicializa a requisição de uma nova página
		 *
		 * Última modificação: 12 fev. 2016
		 */
		public function run(){

			function __autoload($file){

				if(file_exists("application/model/".$file.".php")) require_once "application/model/".$file.".php";
				else if(file_exists("system/model/".$file.".php")) require_once "system/model/".$file.".php";
			}

			$this->loadController();
			$this->loadAction();
		}

		/**
		 * Instancia o controlador correspondente
		 *
		 * Última modificação: 12 fev. 2016
		 */
		private function loadController(){

			if(file_exists("application/controller/".$this->controller.".php")){

				require_once "application/controller/".$this->controller.".php";
			}
			else if (file_exists("system/controller/".$this->controller.".php")) {
				
				require_once "system/controller/".$this->controller.".php";	
			}
			else{

				$this->controller = "error404Controller";
				require_once "system/controller/".$this->controller.".php";	
			}

			try {

				$this->application = new $this->controller();	

			} catch (Exception $e) {
				sleep(2);
				header("Location: http://".$_SERVER['SERVER_NAME']."/FoodExpress");
				
			}
		}	

		/**
		 * Chama o método correspondente referente ao action
		 *
		 * Última modificação: 09 fev. 2016
		 */
		private function loadAction(){

			if ($this->action == null) {
				
				$this->action = "index";
			}
			else if(!method_exists($this->application, $this->action)){

				$this->action = "index";
			}

			$this->application->{$this->action}();
		}

		/**
		 * Carrega as bibliotecas necessárias
		 *
		 * Última modificação: 09 fev. 2016
		 */
		public function loadLibrary(){

			require_once 'system/library/Controller.php';
			require_once 'system/library/Model.php';
		}	

	}