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

			$model = new GerenteModel();
			$model->login();
		}
	}