<?php
	
	/**
	* 
	*/
	class PainelController extends Controller{
		
		/**
		 * Constroi o controller verificando se há uma sessão
		 * de usuário criada, sendo esta requerida para acesso
		 */
		function __construct(){

			session_start();
			session_cache_expire(1800);
			if(!(isset($_SESSION) && strlen($_SESSION['user']) > 3)){
				throw new Exception("Sessão inexistente", 1);
			}
		}

		public function cadastrarEmpresa(){

			
			$primaryKeyCidade = $_POST['cidadeEmpresa'];
			$logradouro = $_POST['logradouroEmpresa'];
			$numeroEndereco = $_POST['numeroEnderecoEmpresa'];
			$bairro = $_POST['bairroEmpresa'];
			$complemento = $_POST['complementoEmpresa'];

			$modelEndereco = new EnderecoModel();
			$primaryKeyEndereco = $modelEndereco->add($logradouro, $numeroEndereco, $bairro, $complemento, $primaryKeyCidade);

			$cnpj = $_POST['cnpjEmpresa'];
			$proprietario = $_POST['proprietarioEmpresa'];
			$nome = $_POST['nomeEmpresa'];
			$chave = $_POST['chaveEmpresa'];
			$senha = $_POST['senhaEmpresa'];

			$modelEmpresa = new EmpresaModel();
			$modelEmpresa->add($cnpj, $proprietario, $nome, $chave, $senha, $primaryKeyEndereco);
		}

		
		public function addDeposito(){

			$model = new DepositoModel();

			$model->add($_POST['nomeDeposito'], $_POST['descricaoDeposito']);
		}

		
		public function cadastrarFuncionario(){

			$modelFuncionario = new FuncionarioModel();
			$primaryKey = $modelFuncionario->add();

			if($_POST['cargo'] == "0"){
				
				$modelLimpeza = new AuxiliarLimpezaModel();
				$modelLimpeza->add($primaryKey);
			}
			else if($_POST['cargo'] == "1"){
				
				$modelGerente = new GerenteModel();
				$modelGerente->add($primaryKey);
			}
			else if($_POST['cargo'] == "2"){

				$modelMotorista = new MotoristaModel();
				$modelMotorista->add($primaryKey);
			}
			else{
	
				$modelSeguranca = new SegurancaModel();
				$modelSeguranca->add($primaryKey); 
			}

		}


		public function cadastrarFornecedor(){

			if($_POST['cidadeFornecedor'] == "0"){

				$nome = $_POST['nomeCidadeFornecedor'];
				$estado = $_POST['estadoCidadeFornecedor'];
				$pais = $_POST['paisCidadeFornecedor'];

				$modelCidade = new CidadeModel();
				$primaryKeyCidade = $modelCidade->add($nome, $estado, $pais);

			}
			else {
				$primaryKeyCidade = $_POST['cidadeFornecedor'];
			}

			$logradouro = $_POST['logradouroFornecedor'];
			$numeroEndereco = $_POST['numeroEnderecoFornecedor'];
			$bairro = $_POST['bairroFornecedor'];
			$complemento = $_POST['complementoFornecedor'];

			$modelEndereco = new EnderecoModel();
			$primaryKeyEndereco = $modelEndereco->add($logradouro, $numeroEndereco, $bairro, $complemento, $primaryKeyCidade);


			$modelFornecedor = new FornecedorModel();
			$primaryKey = $modelFornecedor->add($primaryKeyEndereco);

			if($_POST['tipoFornecedor'] == "0"){
				
				$modelFabrica = new FabricaModel();
				$modelFabrica->add($primaryKey);
			}
			else if($_POST['tipoFornecedor'] == "1"){
				
				$modelAgricultor = new AgricultorModel();
				$modelAgricultor->add($primaryKey);
			}
			else{
	
				$modelOutro = new OutroModel();
				$modelOutro->add($primaryKey); 
			}
		}

		public function finalizarPedido(){

			//Pegando data atual
 			date_default_timezone_set('America/Sao_Paulo');
			$data = date("Y-m-d");
			$dataVencimento = date("Y-m-d",strtotime("+40 day"));

			//Informações do gerente
			$nome = $_SESSION['nomeUsuario'];
			$modeloFuncionarios = new FuncionarioModel();
			$idGerente = $_SESSION['idGerente'];
			$cnpj = $_POST['cnpj'];

			//Informações pagamento
			//$descricao = $_POST['descricaoPagamento'];
			$descricao = $_POST['descricao'];
			$modeloPagamento = new PagamentoModel();

			$num = rand(1, 2000000000);
			$valor = $_POST['total'];
			$idPagamento = $modeloPagamento->add($num, $descricao, $valor, $dataVencimento, $data, $idGerente);
			
			//Informações Pedido
			$modeloPedido = new PedidoModel();
			$numPedido = $modeloPedido->add($data, $idPagamento, $idGerente)[0]['max'];

			$modeloItem = new ItemModel();
			$modeloProduto = new ProdutoModel();
			$modeloEspec = new EspecProdutoModel();

			foreach ($_POST['itens'] as $value) {
				
				$especproduto = $modeloEspec->listarPorNomeEspec($value['produto']);
				$idProduto = $modeloProduto->add($value['valor']*1.25, date("Y-m-d"), date("Y-m-d",strtotime("+30 day")), $especproduto, null, $value['quantidade']);	
				$modeloItem->add($idProduto, $cnpj, $numPedido, $value['quantidade'], $value['valor']);
			}

		}

		public function cadastrarProduto(){

			$modelProduto = new EspecProdutoModel();
			$modelProduto->add();
		}

		public function cadastrarVeiculo(){

			$modelVeiculo = new VeiculoModel();
			$modelVeiculo->add();
		}

		public function finalizarViagem(){ //Nova viagem

			$listaEncomendas = $_POST['lista'];
			$motorista = $_POST['motorista'];
			$veiculo = $_POST['veiculo'];
			$partida = $_POST['dataPartida'];
			$chegada = $_POST['dataChegada'];
			$empresa = $_POST['nomeEmpresa'];
			$descricao = $_POST['descricao'];


			$modeloMotorista = new MotoristaModel();
			$idMotorista = $modeloMotorista->getId($motorista);
			$modeloMotorista->tornarIndisponivel($idMotorista);

			$modeloVeiculo = new VeiculoModel();
			$idVeiculo = $modeloVeiculo->getId($veiculo);
			$modeloVeiculo->tornarIndisponivel($idVeiculo);

			$modeloEmpresa = new EmpresaModel();
			$cnpj = $modeloEmpresa->getId($empresa);

			$gerente = $_SESSION['idGerente'];

			$modeloViagem = new ViagemModel();
			$idViagem = $modeloViagem->add($descricao, $idVeiculo, $idMotorista, $gerente, 1, $partida, $chegada);

			$modeloEncomenda = new EncomendaModel();
			$modeloEncomenda->darBaixa($listaEncomendas, $idViagem);

		}

		public function entradaEncomenda(){

			$idPagamento = $_POST['pagamento'];

			//marcar o status do pagamento da encomenda como pago
			$modeloPagamento = new PagamentoModel();
			$modeloPagamento->tornarPago($idPagamento);

		}

		public function entradaPedido(){

			$idPedido = $_POST['pedido'];
			$idDeposito = $_POST['deposito'];

			//marcar o status do pedido
			$modeloPedido = new PedidoModel();
			$modeloPedido->darBaixa($idPedido);
			$fkPagamento = $modeloPedido->getFkPagamento($idPedido);

			//marcar pagamento do pedido como pago
			$modeloPagamento = new PagamentoModel();
			$modeloPagamento->tornarPago($fkPagamento);

			//identificar em qual deposito os produtos do pedido estão
			$modeloProduto = new ProdutoModel();
			$modeloProduto->darBaixa($idPedido, $idDeposito);
		}

		public function entradaViagem(){

			$idViagem = $_POST['viagem'];

			//marcar o status da viagem
			$modeloViagem = new ViagemModel();
			$modeloViagem->darBaixa($idViagem);

			$idVeiculo = $modeloViagem->getIdVeiculo($idViagem);
			$idMotorista = $modeloViagem->getIdMotorista($idViagem);

			$modeloVeiculo = new VeiculoModel();
			$modeloVeiculo->tornarDisponivel($idVeiculo);

			$modeloMotorista = new MotoristaModel();
			$modeloMotorista->tornarDisponivel($idMotorista);

		}


		/**
		 * Redireciona para a view Painel
		 */
		public function index(){

			$this->view("painel");
		}

		/**
		 * Encerra uma sessão de usuário
		 */
		public function logout(){

			session_destroy();
		}

		//////////////////////////////////////

		public function recuperarViagem(){

			$modeloViagem = new ViagemModel();
			$result = $modeloViagem->getViagem($_POST['id']);

			$data['descricao'] = $result['descricao'];
			$data['partida'] = date_format(date_create($result['dataInicio']),"d/m/Y");
			$data['chegada'] = date_format(date_create($result['dataChegada']),"d/m/Y");

			$modeloGerente = new GerenteModel();
			$data['gerente'] = $modeloGerente->getNome($result['fkGerente']);

			$modeloMotorista = new MotoristaModel();
			$data['motorista'] = $modeloMotorista->getNome($result['fkMotorista']);
			
			$modeloVeiculo = new VeiculoModel();
			$data['veiculo'] = $modeloVeiculo->getPlaca($result['fkVeiculo']);

			$modeloEncomenda = new EncomendaModel();
			$data['dados'] = $modeloEncomenda->getEmpresaEndereco($_POST['id']);

			//echo $data;
			echo json_encode($data);
		}

		public function recuperarFuncionario(){

			$modeloFuncionario = new FuncionarioModel();
			$data['func'] = $modeloFuncionario->getFuncionario($_POST['id']['id']);

			if ($_POST['id']['cargo'] == "Auxiliar") {

				$modelo = new AuxiliarLimpezaModel();
				$data['outro'] = $modelo->getAuxiliar($_POST['id']['id']);
			}
			else if($_POST['id']['cargo'] == "Gerência") {
				$modelo = new GerenteModel();
				$data['outro'] = $modelo->getGerente($_POST['id']['id']);
			}
			else if ($_POST['id']['cargo'] == "Motorista") {
				$modelo = new MotoristaModel();
				$data['outro'] = $modelo->getMotorista($_POST['id']['id']);
			}
			else{
				//segurança
				$modelo = new SegurancaModel();
				$data['outro'] = $modelo->getSeguranca($_POST['id']['id']);
			}

			echo json_encode($data);
		}
		
		public function recuperarEmpresa(){

			$cnpj = $_POST['id'];

			$modeloEmpresa = new EmpresaModel();
			$data['empresa'] = $modeloEmpresa->getEmpresa($cnpj);

			$modeloEndereco = new EnderecoModel();
			$data['endereco'] = $modeloEndereco->getEndereco($data['empresa']['fkEndereco']);

			echo json_encode($data);
		}
	

		//////////////////////////////////////////////
		public function recuperarCidades(){


 			$modelCidade = new CidadeModel();
			$resultSelect = $modelCidade->pesquisa($_POST['id']);
			$opcoesCidade = '';
			for($i = 0; $i < count($resultSelect); $i++){
				$opcoesCidade .= '<option value="'.$resultSelect[$i]['idCidade'].'">'.$resultSelect[$i]['nome'].'</option>';
			} 

			$data['listaCidades'] = $opcoesCidade;
			echo json_encode($data);
 		}

 		public function recuperarDeposito(){
 			$m = new DepositoModel();
 			$data['deposito'] = $m->getDeposito($_POST['id']);
 			echo json_encode($data);
 		}

 		public function recuperarFornecedor(){

 			$m = new FornecedorModel();
 			$data['fornecedor'] = $m->getFornecedor($_POST['id']);
 			$e = new EnderecoModel();
 			$data['endereco'] = $e->getEndereco($data['fornecedor']['fkEndereco']);
 			echo json_encode($data);	
 		}

 		public function recuperarProduto(){

 			$m = new EspecProdutoModel();
 			$data['espec'] = $m->getEspecProduto($_POST['id']);
 			$n = new ProdutoModel();
 			$data['produto'] = $n->getProduto($data['espec']['idEspecProduto']);
 			$n = new DepositoModel();
 			$result = $n->listar();
 			$deposito = "";
 			foreach ($result as $value) {
 				$deposito .= "<option value='{$value['numero']}'>{$value['numero']} - {$value['nome']}</option>";	
 			}

 			$data['deposito'] = $deposito;
 			echo json_encode($data);
 		}

 		public function recuperarVeiculo(){

 			$v = new VeiculoModel();
 			$data['veiculo'] = $v->getVeiculo($_POST['id']); 
 			echo json_encode($data);
 		}

	}