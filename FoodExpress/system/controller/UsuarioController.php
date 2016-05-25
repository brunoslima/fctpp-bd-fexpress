<?php
	

	class UsuarioController extends Controller{


		public function index(){

			$this->view("usuario");
		}

		public function add(){

			$model = new UsuarioModel();
			$model->add();
		}

		public function search(){

			$model = new UsuarioModel();
			$model->search();
		}

		public function atualizar(){

			$model = new UsuarioModel();
			$model->atualizar();
		}

		public function remover(){
			$model = new UsuarioModel();
			$model->remover();
		}

	}