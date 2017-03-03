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
				<br><br><label>Estado</label><br>
				<select name="estado">
					'.$opcoesEstado.'	
				</select><br>
				<label>Cidade</label><br>
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
 			
 			session_start();
 			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d/m/Y');
			$dataVencimento = date('d/m/Y',strtotime("+40 day"));

			$modeloEspecProduto = new EspecProdutoModel();
			$resultEspecProdutos = $modeloEspecProduto->listarTodos();

			$listaP = "";
			foreach ($resultEspecProdutos as $value) {
				$listaP .= "<option value='".$value['nome']."'></option>";
			}


			//Informações da empresa
			$nome = $_SESSION['nomeUsuario'];

 			$html= '<h1>Nova Encomenda</h1>
			<form method="post" action="">
				<p>Informações sobre a encomenda:</p><br>
				<ul>
					<li>Data de Lançamento: ' .$data. '</li>
					<li>Data de Vencimento: ' .$dataVencimento. '</li>
				</ul>			
				<br>
				<p>Abaixo, descreva qualquer informação relevante em relação a esta encomenda:</p><br>
				<textarea name="descricaoPagamento" cols="30" rows="20" placeholder="Descrição"></textarea>
				<br>
				<p>A seguir, adicione todos os produtos que farão parte da encomenda:</p><br><br>
				<label>Produto</label>
				<input type="text" autocomplete="off" placeholder="Digite o nome do produto" name="boxProdutoEncomenda" list="listaProdutos"/>
				<datalist id="listaProdutos">
					'.$listaP.'
				</datalist>
				<label>Quantidade</label>
				<input placeholder="Quantidade unitária" type="number" min="0" step="0.0001" name="quantidadeF"/>
				<button class="btn-adicionar-itemEncomenda">Adicionar</button>
				<p>A tabela a seguir lista todos os itens incluídos na encomenda:</p>
				<table class="item-pedido">
					<thead>
						<th>Código</th>
						<th>Produto</th>
						<th>Quantidade</th>
						<th>Valor Unit.</th>
						<th>Total</th>
					</thead>
					<tbody>
						
					</tbody>
				</table><br>
				<p class="message-alert">Não foram incluídos itens.</p><br><br><br>
				<p class="total-compra">Total da Compra: R$ 0.00</p><br>
				<p>Para finalizar a encomenda, clique em "Finalizar Encomenda".</p>
				<button class="btn-finalizar-encomenda">Finalizar Encomenda</button>
			</form>';

 			echo $html;
 		}

 		public function retornaValorProduto(){

  			session_start();
  			$modeloEspecProduto = new EspecProdutoModel();
  			$valorProduto = $modeloEspecProduto->retornarValorProduto($_POST['nome']);

  			echo $valorProduto;
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
 				$dn = date_format(date_create($value['data']),"d/m/Y");

 				$html .= "<tr><td>{$value['idEncomenda']}</td><td>{$dn}</td><td>{$value['status']}</td></tr>";

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
				<label>Informações Pessoais</label><br>
				<input type="text" placeholder="Nome Completo" name="nome"/>
				<br><br><label>Data de Nascimento</label><br><input type="date" name="dataNascimento"/><br>
				<br><label>Data de Contratação</label><br><input type="date" name="dataContratacao"/><br>
				<input type="number" min="0.01" step="0.01" placeholder="Salário" name="salario"/>
				<br><br><label>Cargo</label><br>
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
					<input type="email" name="login" placeholder="E-mail de Login" /><br>
					<input type="password" name="senha" placeholder="Senha" />
					<input type="password" name="confirmsenha" placeholder="Confirmação de Senha" />	
				</div>
				<div class="opt2">
					<label>Categoria de Habilitação</label><br>
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
					<label>Informações de Contato</label><br>
					<input type="text" name="codigo" placeholder="Código"/>
					<input type="text" name="area" placeholder="Área"/>
					<input type="text" name="numero" placeholder="Número"/><br><br>
					<label>Chave de Acesso e senha para o sistema</label><br>
					<input type="text" name="chaveMotorista" placeholder="Chave de acesso"/>
					<input type="text" name="senhaMotorista" placeholder="Senha"/>
				</div>
				<div class="opt3">
					<label>Possui porte de arma? </label><br>
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

 				$dn = date_format(date_create($value['dataNascimento']),"d/m/Y");
 				$dc = date_format(date_create($value['dataContratacao']),"d/m/Y");
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ ".number_format($value['salario'], 2,",",'')."</td><td>{$cargo}</td><td>{$dn}</td><td>{$dc}</td></tr>";
 			}

 			$cargo = "Gerência";
 			foreach ($result['gerente'] as $value) {
 				$dn = date_format(date_create($value['dataNascimento']),"d/m/Y");
 				$dc = date_format(date_create($value['dataContratacao']),"d/m/Y");
 				if($value['nome'] != "Administrador") {
 					$html .= "<tr><td>{$value['nome']}</td><td>R$ ".number_format($value['salario'], 2,",",'')."</td><td>{$cargo}</td><td>{$dn}</td><td>{$dc}</td></tr>";
 				}
 					
 			}

 			$cargo = "Motorista";
 			foreach ($result['motorista'] as $value) {
 				$dn = date_format(date_create($value['dataNascimento']),"d/m/Y");
 				$dc = date_format(date_create($value['dataContratacao']),"d/m/Y");
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ ".number_format($value['salario'], 2,",",'')."</td><td>{$cargo}</td><td>{$dn}</td><td>{$dc}</td></tr>";
 			}

 			$cargo = "Segurança";
 			foreach ($result['seguranca'] as $value) {
 				$dn = date_format(date_create($value['dataNascimento']),"d/m/Y");
 				$dc = date_format(date_create($value['dataContratacao']),"d/m/Y");
 				$html .= "<tr><td>{$value['nome']}</td><td>R$ ".number_format($value['salario'], 2,",",'')."</td><td>{$cargo}</td><td>{$dn}</td><td>{$dc}</td></tr>";
 			}

 			$html .= "</tbody></table>";
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
				<label>Informações Gerais</label><br>
				<input type="text" placeholder="Cnpj" name="cnpjFornecedor"/><br>
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
				<br><br>
				<label>Informações de Contato</label><br>
				<input type="text" name="codigoFornecedor" placeholder="Código"/>
				<input type="text" name="areaFornecedor" placeholder="Área"/>
				<input type="text" name="numeroFornecedor" placeholder="Número"/>
				<br><br>
				<label>Localização</label><br>
				<input type="text" name="logradouroFornecedor" placeholder="Logradouro"/>
				<input type="text" name="numeroEnderecoFornecedor" placeholder="Número"/><br>
				<br><input type="text" name="bairroFornecedor" placeholder="Bairro"/>
				<input type="text" name="complementoFornecedor" placeholder="Complemento"/><br>
				<br><br><label>Estado</label><br>
				<select name="estado">
					'.$opcoesEstado.'	
				</select><br>
				<label>Cidade</label><br>
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
 				$dv = date_format(date_create($value['dataEmissao']),"d/m/Y");
 				$de = date_format(date_create($value['dataVencimento']),"d/m/Y");
 				$html .= "<tr><td>{$value['idPagamento']}</td><td>{$value['numeroBoleto']}</td><td>{$value['descricao']}</td><td>R$ ".number_format($value['valor'], 2,",",'')."</td><td>{$dv}</td><td>{$de}</td><td>{$value['status']}</td><td>{$value['fkGerente']}</td></tr>";
 			}

 			$html .= "</tbody></table>";
 			echo $html;

 		}

		public function novopedido(){
 			session_start();
 			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d/m/Y');
			$dataVencimento = date('d/m/Y',strtotime("+40 day"));

			$listaP = "";
			
			$modelFornecedor = new FornecedorModel();
			$result = $modelFornecedor->listar();
			
			
			$listaF = "";
			foreach ($result as $value) {
				$listaF .= "<option value='".$value['nome']."'></option>";
			}


			//Informações do gerente
			$nome = $_SESSION['nomeUsuario'];

 			$html= '<h1>Novo Pedido</h1>
			<form method="post" action="">
				<p>Informações sobre o pedido:</p><br>
				<ul>
					<li>Data de Lançamento: ' .$data. '</li>
					<li>Data de Vencimento: ' .$dataVencimento. '</li>
					<li>Gerente Responsável: '.$nome. '</li>
				</ul>			
				<br>
				<p>Abaixo, descreva qualquer informação relevante em relação a este pedido:</p><br>
				<textarea name="descricaoPagamento" cols="30" rows="20" placeholder="Descrição"></textarea>
				<br>
				<p>A seguir, adicione todos os produtos que farão parte do pedido:</p><br><br>
				<label>Fornecedor</label>
				<input type="text" name="boxFornecedor" autocomplete="off" list="listaFornecedor" placeholder="Digite o nome do fornecedor"/>
				<datalist id="listaFornecedor">
					'.$listaF.'
				</datalist>
				<label>Produto</label>
				<input type="text" autocomplete="off" placeholder="Digite o nome do produto" name="boxProduto" list="listaProdutos"/>
				<datalist id="listaProdutos">
					'.$listaP.'
				</datalist>
				<br><br>
				<label>Quantidade</label>
				<input placeholder="Quantidade unitária" type="number" min="0" step="0.0001" name="quantidadeF"/>
				<label>Valor(R$):</label>
				<input placeholder="Valor unitário" type="number" min="0" step="0.01" name="valorF"/><br>
				<button class="btn-adicionar-item">Adicionar</button>
				<p>A tabela a seguir lista todos os itens incluídos no pedido:</p>
				<table class="item-pedido">
					<thead>
						<th>Código</th>
						<th>Produto</th>
						<th>Fornecedor</th>
						<th>Quantidade</th>
						<th>Valor Unit.</th>
						<th>Total</th>
					</thead>
					<tbody>
						
					</tbody>
				</table><br>
				<p class="message-alert">Não foram incluídos itens.</p><br><br><br>
				<p class="total-compra">Total da Compra: R$ 0.00</p><br>
				<p>Para finalizar o pedido, clique em "Finalizar Pedido".</p>
				<button class="btn-finalizar-pedido">Finalizar Pedido</button>
			</form>';

 			echo $html;
 		}

 		public function listarP(){
 			session_start();
 			$model = new EspecProdutoModel();
 			$result = $model->listarProdutos($_POST['nome']);

 			$html['id'] = $_SESSION['idFornecedor'];
 			$html['nome'] = $_POST['nome'];
 			$html['pagina'] = "";
 			foreach ($result as $value) {
 				$html['pagina'] .= "<option data-id='".$value['cod']."' value='".$value['nome']."'></option>";
 			}

 			echo json_encode($html);
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

 			$model = new FornecedorModel();
 			$result = $model->listar();
 			$list = "";
 			foreach ($result as $value) {
 				$list .= "<option value='".$value['cnpj']."'>".$value['nome']."</option>";
 			}

 			$html = '<h1>Novo Produto</h1>
			<form method="post" action="">
				<label>Nome do produto</label><br>
				<input type="text" placeholder="Insira o nome do produto" name="nomeProduto"/><br>
				<label>Descrição</label><br>
				<input type="text" placeholder="Insira a descrição" name="descricaoProduto"/><br>
				<label>Selecione o fornecedor</label><br>
				<select name="fornecedor" id="forn">
					'.$list.'
				</select>
				<button class="btn-cadastrar-produto">Cadastrar</button>
			</form>';

 			echo $html;
 		}

 		public function mostrarproduto(){

 			$modeloProduto = new EspecProdutoModel();
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

 			$modeloVeiculo = new VeiculoModel();
 			$result = $modeloVeiculo->listarDisponiveis();

 			$listaVeiculos = "";
			foreach ($result as $value) {
				$listaVeiculos .= "<option value='".$value['placa']."'></option>";
			}

			$modeloMotorista = new MotoristaModel();
			$result = $modeloMotorista->listarDisponiveis();

			$listaMotoristas = "";
			foreach ($result as $value) {
				$listaMotoristas .= "<option value='".$value['nome']."'></option>";
			}

			$modeloEmpresa = new EmpresaModel();
			$result = $modeloEmpresa->listarEmpresasComEncomenda();

			$listaEmpresas = "";
			foreach ($result as $value) {
				$listaEmpresas .= "<option value='".$value['nome']."'></option>";
			}

			session_start();

 			$html = '<h1>Nova Viagem</h1>
 			<p>As viagens referem-se às entregas de encomendas realizadas a empresas cadastradas no sistema.</p><br>
			<form method="post" action="">
				<label><b>Gerente Responsável:</b> '.$_SESSION['nomeUsuario'].'</label><br><br><br>
				<label>Descrição</label><br>
				<textarea name="descricaoviagem" cols="30" rows="10"></textarea><br>
				<label>Veículo de Carga</label><br>
				<input type="text" autocomplete="off" list="listaveiculos" placeholder="Selecione um veículo" name="veiculoviagem"/>
				<datalist id="listaveiculos">
					'.$listaVeiculos.'
				</datalist><br>
				<label>Motorista</label><br>
				<input type="text" autocomplete="off" placeholder="Selecione um motorista" list="listamotoristas" name="motoristaviagem"/>
				<datalist id="listamotoristas">
					'.$listaMotoristas.'
				</datalist><br>
				<label>Data de Partida</label><br>
				<input type="date" name="datapartida"><br>
				<label>Data de Chegada</label><br>
				<input type="date" name="datachegada"><br>
				<label>Selecionar empresa</label><br>
				<input type="text" autocomplete="off" placeholder="Selecione uma empresa específica" list="listaempresas" name="empresaviagem"/>
				<datalist id="listaempresas">
					'.$listaEmpresas.'
				</datalist><br><br><br>
				<div id="listaEncomendasViagem">
					<label>Abaixo estão listadas as encomendas referentes as empresas</label>
					<table>
						<thead>
							<th>Código Encomenda</th>
							<th>Data</th>
							<th>Preço Total</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
				<br>
				<button class="btn-finalizar-viagem">Finalizar viagem</button>
			</form>';

			echo $html;
 		}

 		public function mostrarviagem(){

 			$modeloViagem = new ViagemModel();
 			$result = $modeloViagem->listarTodos();

 			$html = "
 			<table>
				<thead>
					<th>Código</th>
					<th>Descrição</th>
					<th>Veículo</th>
					<th>Motorista</th>
					<th>Gerente</th>
					<th>Status</th>
					<th>Data Inicio</th>
					<th>Data Chegada</th>
				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr style='cursor:pointer' data-id='{$value['idViagem']}' class='panel-viagem'><td>{$value['idViagem']}</td><td>{$value['descricao']}</td><td>{$value['fkVeiculo']}</td><td>{$value['fkMotorista']}</td><td>{$value['fkGerente']}</td><td>{$value['status']}</td><td>{$value['dataInicio']}</td><td>{$value['dataChegada']}</td></tr>";
 			}

 			$html .= "</tbody></table>";
 			echo $html;

 		}

 		public function mostrarviagemmotorista(){

 			session_start();
 			$idMotorista = $_SESSION['idMotorista'];

 			$modeloViagem = new ViagemModel();
 			$result = $modeloViagem->listarViagensMotorista($idMotorista);

 			$html = "
 			<table>
				<thead>
					<th>Código</th>
					<th>Descrição</th>
					<th>Veículo</th>
					<th>Gerente</th>
					<th>Status</th>
					<th>Data Inicio</th>
					<th>Data Chegada</th>


				</thead>
				<tbody>
			";

 			foreach ($result as $value) {
 				$html .= "<tr><td>{$value['idViagem']}</td><td>{$value['descricao']}</td><td>{$value['fkVeiculo']}</td><td>{$value['fkGerente']}</td><td>{$value['status']}</td><td>{$value['dataInicio']}</td><td>{$value['dataChegada']}</td></tr>";

 			}

 			$html .= "</tbody></table>";
 			echo $html;
 		}

 		public function novoveiculo(){

 			$html = '<h1>Novo Veículo</h1>
			<form method="post" action="">
				<label>Informações Veiculares</label><br>
				<input type="text" placeholder="Placa" name="placaVeiculo"/><br>
				<input type="text" placeholder="Ano de fabricação" name="anoVeiculo"/><br>
				<input type="text" placeholder="Modelo" name="modeloVeiculo"/><br>
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

			$status = "";
 			foreach ($result as $value) {
 				$status = ($value['disponivel'] == 1 ? "Disponível" : "Ocupado");
 				$html .= "<tr><td>{$value['idVeiculo']}</td><td>{$value['placa']}</td><td>{$value['ano']}</td><td>{$value['modelo']}</td><td>{$value['capacidade']}</td><td>{$status}</td></tr>";

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

 		public function entradapedido(){

 			$modeloPedido = new PedidoModel();
 			$resultSelect = $modeloPedido->listarTodos();
 			$listaPedidos = "";
 			for($i = 0; $i < count($resultSelect); $i++){
				
 				if ($resultSelect[$i]['status'] == 0) {
					$listaPedidos .= '<option value="'.$resultSelect[$i]['idPedido'].'"> Nº '.$resultSelect[$i]['idPedido']." - ".date_format(date_create($resultSelect[$i]['dataPedido']),"d/m/Y").'</option>';
 				}
			} 

			$listaDepositos = "";
			$modeloDeposito = new DepositoModel();
			$result = $modeloDeposito->listar();

			for($i = 0; $i < count($result); $i++){
				
				$listaDepositos .= '<option value="'.$result[$i]['numero'].'"> Nº '.$result[$i]['numero']." - ".$result[$i]['nome'].'</option>';
			}

 			$html = '<h1>Registrar Entrada de Pedido</h1>
			<form method="post" action="">
				<label>Esta seção refere-se ao registro de entradas de pedidos realizados aos fornecedores que entram na distribuidora.</label><br>
				<br><br>
				<label>Selecione o pedido</label><br>
				<select name="listapedidoentrada">
					'.$listaPedidos.'
				</select>
				<br>
				<label>Selecione o depósito</label><br>
				<select name="listadepositoentrada">
					'.$listaDepositos.'
				</select>
				<button class="btn-confirmar-entrada">Confirmar</button>
			</form>';

 			echo $html;
 		}

 		public function listarEncomendasViagem(){

 			$nome = $_POST['nome'];

 			$modeloEmpresa = new EmpresaModel();
 			$modeloEncomenda = new EncomendaModel();

 			$idEmpresa = $modeloEmpresa->getId($nome);


 			$result = $modeloEncomenda->listarDescricao($idEmpresa);
 			$html["pagina"] = "";
 			$html["encomendas"] = $result; 

 			foreach ($result as $value) {
 				$html["pagina"] .= "<tr><td>{$value['id']}</td><td>{$value['data']}</td><td>{$value['total']}</td></tr>";
 			}

 			echo json_encode($html);
 		}
 		
 	}