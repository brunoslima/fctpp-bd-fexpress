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


 		public function novofornecedor(){

 			

 			$html = '<h1>Novo Fornecedor</h1>
			<form method="post" action="">
				<input type="text" placeholder="Cnpj" name="cnpjFornecedor"/>
				<input type="text" placeholder="Nome Completo" name="nomeFornecedor"/>
				<input type="email" placeholder="E-mail de Contato" name="emailFornecedor"/>
				<label>Tipo</label>
				<select name="tipoFornecedor">
					<optgroup>
						<option value="0">Fabrica</option>
						<option value="1">Agricultor</option>
						<option value="2">Outro</option>
					</optgroup>
				</select>
				<br>
				<label>Telefone</label>
				<input type="text" name="codigoFornecedor" placeholder="Código"/>
				<input type="text" name="areaFornecedor" placeholder="Área"/>
				<input type="text" name="numeroFornecedor" placeholder="Número"/>
				<br>
				<label>Endereço</label>
				<input type="text" name="logradouroFornecedor" placeholder="Logradouro"/>
				<input type="text" name="numeroEnderecoFornecedor" placeholder="Número"/>
				<input type="text" name="bairroFornecedor" placeholder="Bairro"/>
				<input type="text" name="complementoFornecedor" placeholder="Complemento"/>
				<label>Cidade</label>
				<select name="cidadeFornecedor">
					<optgroup>
						<option value="0">Nova cidade</option>
						<option value="1">Presidente Prudente</option>
						<option value="2">Martinopolis</option>
					</optgroup>
				</select>
				<div class="optNovaCidade" style="display:block">
					<label>Nova Cidade</label>
					<input type="text" name="nomeCidadeFornecedor" placeholder="Nome da cidade" />
					<input type="text" name="estadoCidadeFornecedor" placeholder="Estado" />
					<input type="text" name="paisCidadeFornecedor" placeholder="Pais" />				
				</div>
				<button class="btn-cadastrar-fornecedor">Cadastrar</button>
			</form>';

 			echo $html;
 		}

 		public function novoveiculo(){

 			$html = '<h1>Novo Veículo</h1>
			<form method="post" action="">
				<input type="text" placeholder="Placa" name="placaVeiculo"/>
				<input type="text" placeholder="Ano de fabricação" name="anoVeiculo"/>
				<input type="text" placeholder="Modelo" name="modeloVeiculo"/>
				<input type="text" placeholder="Capacidade de carga" name="capacidadeVeiculo"/>
				<button class="btn-cadastrar-veiculo">Cadastrar</button>
			</form>';

 			echo $html;
 		}
 		
 	}