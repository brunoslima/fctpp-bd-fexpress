<?php

 	/**
 	* 
 	*/
 	class GUIController extends Controller{
 		
 		function __construct(){
 			
 		}

 		public function exibirPaginaInicial(){

			$html = '<br>	
			<h1>Bem-Vindo ao FoodExpress</h1>
			<p>A FoodExpress é uma distribuidora de alimentos criada em 2010 que tem como lema "So fast how you want!"</p>
			<p>Prezado <strong>admin</strong> está conectado como <strong>Administrador</strong></p>';

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
				<br><label>Estado</label>
				<select name="estado">
					'.$opcoesEstado.'	
				</select>
				<label>Cidade</label>
				<select name="cidade">
					'.$opcoesCidade.'
				</select>
				<button class="btn-cadastrar-empresa">Cadastrar</button>
			</form>';

 			echo $html;
 		}



 		public function mostrarempresa(){

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

 		public function novaencomenda(){

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


 		public function novodeposito(){
 			
 			$html = '<h1>Novo Depósito</h1>
			<form method="post" action="">
				<input type="text" placeholder="Nome" name="nomeDeposito"/>
				<textarea name="descricaoDeposito" cols="30" rows="20" placeholder="Descrição"></textarea>
				<button class="btn-cadastrar-deposito">Cadastrar</button>
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

 		public function novofornecedor(){

 			$modelEstado = new EstadoModel();
 			$resultSelect = $modelEstado->pesquisa();

 			$estadoParte = '';

 			/*$cidadesParte = '<option value="'.$resultSelect[0]['idCidade'].'">'.$resultSelect[0]['nome'].'</option>';*/
			
			for($i = 0; $i < count($resultSelect); $i++){
				$estadoParte .= '<option value="'.$resultSelect[$i]['id'].'">'.$resultSelect[$i]['nome'].'</option>';
			}


 			$html = '<h1>Novo Fornecedor</h1>
			<form method="post" action="">
				<input type="text" placeholder="Cnpj" name="cnpjFornecedor"/><br>
				<input type="text" placeholder="Nome Completo" name="nomeFornecedor"/>
				<input type="email" placeholder="E-mail de Contato" name="emailFornecedor"/><br>
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
				<input type="text" name="numeroEnderecoFornecedor" placeholder="Número"/><br>
				<input type="text" name="bairroFornecedor" placeholder="Bairro"/>
				<input type="text" name="complementoFornecedor" placeholder="Complemento"/><br>
				<label>Cidade</label>
				<select name="estado">
					<optgroup>
						<option value="0">Nova cidade</option>' . $estadoParte . '
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

 		public function mostrarpagamentos(){

 			$modeloPagamento = new PagamentoModel();
 			$result = $modeloPagamento->listarTodos();

 			$html = "
 			<table>
				<thead>
					<th>Codigo</th>
					<th>Numero boleto</th>
					<th>Descrição</th>
					<th>Valor</th>
					<th>Data vencimento</th>
					<th>Data emissão</th>
					<th>Situação</th>
					<th>Gerente responsável</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['idPagamento']}</td><td>{$value['numeroboleto']}</td><td>{$value['descricao']}</td><td>{$value['valor']}</td><td>{$value['dataVencimento']}</td><td>{$value['dataEmissao']}</td><td>{$value['status']}</td><td>{$value['fkGerente']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;

 		}

 		public function novopedido(){

 			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d/m/Y');
			$dataVencimento = date('d/m/Y', strtotime($data.' +2 days'));

			//Informações do gerente
			$nome = "admin";

 			$html = '<h1>Novo Pedido</h1>
			<form method="post" action="">
				<label>Data do pedido: ' .$data. '</label>
				<label>Gerente responsável: '.$nome. '</label><br><br>
				<textarea name="descricaoPagamento" cols="30" rows="20" placeholder="Descrição"></textarea>
				<button class="btn-cadastrar-pedido">Cadastrar</button>
			</form>';

 			echo $html;
 		}

 		public function mostrarpedido(){

 			$modeloPedido = new PedidoModel();
 			$result = $modeloPedido->listarTodos();

 			$html = "
 			<table>
				<thead>
					<th>Numero</th>
					<th>Data</th>
					<th>Situação</th>
					<th>Código do Pagamento</th>
					<th>Código do Gerente</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['idPedido']}</td><td>{$value['dataPedido']}</td><td>{$value['status']}</td><td>{$value['fkPagamento']}</td><td>{$value['fkGerente']}</td></tr>";

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

 		public function mostrarproduto(){

 			$modeloProduto = new ProdutoModel();
 			$result = $modeloProduto->listarTodos();

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
 				$html .= "<tr><td>{$value['idEspecProduto']}</td><td>{$value['nome']}</td><td>{$value['descricao']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;

 		}

 		public function novaviagem(){


 		}

 		public function mostrarviagem(){


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

 			$modeloVeiculo = new VeiculoModel();
 			$result = $modeloVeiculo->listarTodos();

 			$html = "
 			<table>
				<thead>
					<th>Código</th>
					<th>Placa</th>
					<th>Ano</th>
					<th>Modelo</th>
					<th>Capacidade</th>
					<th>Status</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['idVeiculo']}</td><td>{$value['placa']}</td><td>{$value['ano']}</td><td>{$value['modelo']}</td><td>{$value['capacidade']}</td><td>{$value['disponivel']}</td></tr>";

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