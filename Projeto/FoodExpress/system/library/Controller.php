<?php


	class Controller{

		/**
		 * Exibe a página ao usuário
		 * @param  String $name Nome sem extensão do arquivo referente á página
		 * @param  Array  $vars Parâmetros adicionais para carregamento de conteúdo de dinâmico
		 *
		 * Última modificação: 09 fev. 2016
		 */
		protected function view($name, $vars = null){

			if (is_array($vars) && count($vars) > 0) {
				
				extract($vars, EXTR_PREFIX_ALL, "view");
			}

			require_once "system/config/constant.php";
			
			if(file_exists("application/view/".$name.".php")) require_once 'application/view/'.$name.'.php';
			else require_once 'system/view/'.$name.'.php';
		}

	}