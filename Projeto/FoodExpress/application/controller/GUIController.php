<?php

 	/**
 	* 
 	*/
 	class GUIController extends Controller{
 		
 		function __construct(){
 			
 		}

 		public function verencomendas(){

 			$model = new EncomendaModel();
 			$result = $model->listar();

 			$html = "
 			<table>
				<thead>
					<th>Código</th>
					<th>Data de realização</th>
					<th>Status</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['idEncomenda']}</td><td>{$value['data']}</td><td>{$value['status']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function novofuncionario(){

 			$html = '<h1>Novo Funcionário</h1>
			<form method="post" action="">
				<label>Informações Pessoais</label><br>
				<input type="text" placeholder="Nome Completo" name="nome"/>
				<input type="number" min="0.01" step="0.01" placeholder="Salário" name="salario"/>
				<br><br><label>Data de Nascimento</label><br><input type="date" name="dataNascimento"/><br>
				<br><label>Data de Contratação</label><br><input type="date" name="dataContratacao"/><br>
				<br><label>Cargo</label><br>
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
					<br><input type="email" name="login" placeholder="E-mail de Login" />
					<br><input type="password" name="senha" placeholder="Senha" />
					<input type="password" name="confirmsenha" placeholder="Confirmação de Senha" />	
				</div>
				<div class="opt2">	
					<br><label>Categoria de Habilitação</label><br>
					<select name="Categoria">
						<optgroup>
							<option value="0">A</option>
							<option value="1">B</option>
							<option value="2">C</option>
							<option value="3">D</option>
							<option value="4">E</option>
						</optgroup>
					</select>
					<br><br>
					<label>Telefone</label><br>
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

 		public function listarDepositos(){

 			$model = new DepositoModel();
 			$result = $model->listar();

 			$html = "
 			<table>
				<thead>
					<th>Código</th>
					<th>Nome</th>
					<th>Descrição</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['numero']}</td><td>{$value['nome']}</td><td>{$value['descricao']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function listarFuncionarios(){
 			$model = new FuncionarioModel();
 			$result = $model->listar();

 			$html = "
 			<table>
				<thead>
					<th>Nome Completo</th>
					<th>Salário</th>
					<th>Cargo</th>
					<th>Data de Nascimento</th>
					<th>Data de Contratação</th>
				</thead>
				<tbody>
			";

			$cargo = "Auxiliar de Limpeza";
 			foreach ($result['limpeza'] as $value) {
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ {$value['salario']}</td><td>{$cargo}</td><td>{$value['dataNascimento']}</td><td>{$value['dataContratacao']}</td></tr>";
 			}

 			$cargo = "Gerência";
 			foreach ($result['gerente'] as $value) {
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ {$value['salario']}</td><td>{$cargo}</td><td>{$value['dataNascimento']}</td><td>{$value['dataContratacao']}</td></tr>";
 			}

 			$cargo = "Motorista";
 			foreach ($result['motorista'] as $value) {
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ {$value['salario']}</td><td>{$cargo}</td><td>{$value['dataNascimento']}</td><td>{$value['dataContratacao']}</td></tr>";
 			}

 			$cargo = "Segurança";
 			foreach ($result['seguranca'] as $value) {
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ {$value['salario']}</td><td>{$cargo}</td><td>{$value['dataNascimento']}</td><td>{$value['dataContratacao']}</td></tr>";
 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function novodeposito(){
 			$html = '<h1>Novo Depósito</h1>
			<form method="post" action="">
				<input type="text" placeholder="Nome" name="nomeDeposito"/>
				<textarea name="descricaoDeposito" cols="30" rows="20" placeholder="Descrição"></textarea>
				<button class="btn-cadastrar-deposito">Cadastrar</button>
			</form>';

 			echo $html;
 		}


 		public function novofornecedor(){

 			$modelEstado = new EstadoModel();
 			$resultSelect = $modelEstado->pesquisa();

 			$opcoesEstado = '';
			
			for($i = 0; $i < count($resultSelect); $i++){
				$opcoesEstado .= '<option value="'.$resultSelect[$i]['id'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 	

			$modelCidade = new CidadeModel();
			$resultSelect = $modelCidade->pesquisa(1);
			$opcoesCidade = '';
			for($i = 0; $i < count($resultSelect); $i++){
				$opcoesCidade .= '<option value="'.$resultSelect[$i]['idCidade'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 


 			$html = '<h1>Novo Fornecedor</h1>
			<form method="post" action="">
				<label>Informações de Identificação</label><br>
				<input type="text" placeholder="CNPJ" name="cnpjFornecedor"/><br>
				<input type="text" placeholder="Nome Completo" name="nomeFornecedor"/>
				<input type="email" placeholder="E-mail de Contato" name="emailFornecedor"/><br>
				<br><label>Categoria</label><br>
				<select name="tipoFornecedor">
					<optgroup>
						<option value="0">Fabrica</option>
						<option value="1">Agricultor</option>
						<option value="2">Outro</option>
					</optgroup>
				</select>
				<br>
				<br><label>Informações de Comunicação</label><br>
				<input type="text" name="codigoFornecedor" placeholder="Código"/>
				<input type="text" name="areaFornecedor" placeholder="Área"/>
				<input type="text" name="numeroFornecedor" placeholder="Número"/>
				<br><br>
				<label>Informações de Localização</label><br>
				<input type="text" name="logradouroFornecedor" placeholder="Logradouro"/>
				<input type="text" name="numeroEnderecoFornecedor" placeholder="Número"/><br>
				<input type="text" name="bairroFornecedor" placeholder="Bairro"/>
				<input type="text" name="complementoFornecedor" placeholder="Complemento"/><br>
				<select name="estado">
					'.$opcoesEstado.'	
				</select>
				<select name="cidade">
					'.$opcoesCidade.'
				</select>
				<button class="btn-cadastrar-fornecedor">Cadastrar</button>
			</form>';

 			echo $html;
 		}

 		public function listarfornecedores(){

 			$model = new FornecedorModel();
 			$result = $model->listar();

 			$html = "
 			<table>
				<thead>
					<th>CNPJ</th>
					<th>Nome Completo</th>
					<th>E-mail</th>
					<th>Telefone</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['cnpj']}</td><td>{$value['nome']}</td><td>{$value['email']}</td><td>+{$value['codigo']} {$value['area']} {$value['numero']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function novoproduto(){

 			$html = '<h1>Novo Produto</h1>
			<form method="post" action="">
				<input type="text" placeholder="Nome" name="nomeProduto"/>
				<input type="text" placeholder="Descrição" name="descricaoProduto"/>
				<button class="btn-cadastrar-produto">Cadastrar</button>
			</form>';

 			echo $html;
 		}

 		public function mostrarprodutos(){

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

 		public function mostrarveiculo(){

 			$html = 
 			'<table id="datatables" class="display" cellspacing="0" width="100%">
				  <thead>
				    <!--<tr>
				      <th>Veículos</th>
				    </tr>-->
				    <tr>
				      <th>Nº</th>
				      <th>Placa</th>
				      <th>Ano fabricação</th>
				      <th>Modelo</th>
				      <th>Capacidade de carga</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>2</td>
				      <td>GCV-1234</td>
				      <td>2015</td>
				      <td>2016</td>
				      <td>800 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>FGH-3456</td>
				      <td>2010</td>
				      <td>2011</td>
				      <td>600 kg</td>
				      <!--<td>
				        <i class="fa fa-pencil button alterar"></i>
				        <i class="fa fa-trash button excluir"></i>
				      </td>-->
				    </tr>
				  </tbody>
			</table>';

			echo $html;
 		}

 		public function novaempresa(){

			$modelEstado = new EstadoModel();
 			$resultSelect = $modelEstado->pesquisa();

 			$opcoesEstado = '';
			
			for($i = 0; $i < count($resultSelect); $i++){
				$opcoesEstado .= '<option value="'.$resultSelect[$i]['id'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 	

			$modelCidade = new CidadeModel();
			$resultSelect = $modelCidade->pesquisa(1);
			$opcoesCidade = '';
			for($i = 0; $i < count($resultSelect); $i++){
				$opcoesCidade .= '<option value="'.$resultSelect[$i]['idCidade'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 			

 			$html = '<h1>Nova Empresa</h1>
			<form method="post" action="">
				<br>
				<label>Informações Empresariais</label><br>
				<input type="text" placeholder="CNPJ" name="cnpjEmpresa"/><br>
				<input type="text" placeholder="Nome da empresa" name="nomeEmpresa"/>
				<input type="text" placeholder="Proprietario" name="proprietarioEmpresa"/><br>
				<br><label>Informações de Acesso</label><br>
				<input type="text" placeholder="Chave de acesso" name="chaveEmpresa"/>
				<input type="text" placeholder="Senha" name="senhaEmpresa"/><br>
				<br>
				<label>Localização</label><br>
				<input type="text" name="logradouroEmpresa" placeholder="Logradouro"/>
				<input type="text" name="numeroEnderecoEmpresa" placeholder="Número"/><br>
				<input type="text" name="bairroEmpresa" placeholder="Bairro"/>
				<input type="text" name="complementoEmpresa" placeholder="Complemento"/>
				<br>
				<select name="estado">
					'.$opcoesEstado.'	
				</select>
				<select name="cidade">
					'.$opcoesCidade.'
				</select>
				<button class="btn-cadastrar-empresa">Cadastrar</button>
			</form>';

 			echo $html;
 		}



 		public function listarempresas(){

			$model = new EmpresaModel();
 			$result = $model->selectAll(); 			

 			$html = "
 			<table>
				<thead>
					<th>CNPJ</th>
					<th>Nome da Empresa</th>
					<th>Proprietário</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['cnpj']}</td><td>{$value['nome']}</td><td>{$value['proprietario']}</td></tr>";
 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function listarCidades(){

 			//realizando a pesquisa pelas cidades quando se tem o id do estado
 			$model = new CidadeModel();
 			$resultSelect = $model->pesquisa($_POST['id']);
 			$html = '';
 			for($i = 0; $i < count($resultSelect); $i++){
				$html .= '<option value="'.$resultSelect[$i]['idCidade'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 
			
			echo $html;	
 		}
 		
 	}