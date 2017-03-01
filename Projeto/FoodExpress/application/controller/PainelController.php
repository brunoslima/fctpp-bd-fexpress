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
		
	}