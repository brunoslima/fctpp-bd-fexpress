<?php

 	/**
 	* 
 	*/
 	class GUIController extends Controller{
 		
 		function __construct(){
 			
 		}

 		public function novofuncionario(){

 			$html = '<h1>Novo Funcionário</h1>
			<form method="post" action="">
				<input type="text" placeholder="Nome Completo" name="nome"/>
				<input type="number" min="0.01" step="0.01" placeholder="Salário" name="salario"/>
				<label>Data de Nascimento</label><input type="date" name="dataNascimento"/><br>
				<label>Data de Contratação</label><input type="date" name="dataContratacao"/><br>
				<label>Cargo</label>
				<select name="cargo">
					<optgroup>
						<option value="0">Auxiliar Limpeza</option>
						<option value="1">Gerente</option>
						<option value="2">Motorista</option>
						<option value="3">Segurança</option>
					</optgroup>
				</select>
				<div class="opt0" style="display:block">
					<input type="text" name="setor" placeholder="Setor" />
				</div>
				<div class="opt1">
					<input type="email" name="contato" placeholder="E-mail de Contato" />
					<input type="email" name="login" placeholder="E-mail de Login" />
					<input type="password" name="senha" placeholder="Senha" />
					<input type="password" name="confirmsenha" placeholder="Confirmação de Senha" />	
				</div>
				<div class="opt2">
					<label>Categoria de Habilitação</label>
					<select name="Categoria">
						<optgroup>
							<option value="0">A</option>
							<option value="1">B</option>
							<option value="2">C</option>
							<option value="3">D</option>
							<option value="4">E</option>
						</optgroup>
					</select>
					<br>
					<label>Telefone</label>
					<input type="text" name="codigo" placeholder="Código"/>
					<input type="text" name="area" placeholder="Área"/>
					<input type="text" name="numero" placeholder="Número"/>
				</div>
				<div class="opt3">
					<label>Possui porte de arma? </label>
					<select name="porte">
						<optgroup>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</optgroup>
					</select>
				</div>
				<button class="btn-cadastrar-funcionario">Cadastrar</button>
			</form>';

			echo $html;
 		}
 		
 	}