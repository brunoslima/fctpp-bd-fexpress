<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8"/>
	
	<title>FoodExpress</title>
	<!--&callback=inicializarMapa-->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXt4eQQuIrffLkbrjcTcxE4E46RO7Qycs"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>jquery-3.1.1.min.js"></script>
	
	<script type="text/javascript" src="<?php echo $assets['script']?>painel-usuario.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>painel-acesso.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-encomendas.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-deposito.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-fornecedores.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-funcionarios.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pagamentos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pedidos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-veiculos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-produto.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-empresas.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-viagem.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>painelStyle.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>painelJanela.css">	
	<link rel="shortcut icon" href="<?php echo $assets['images']?>logo_transparent.png">	

</head>
<body>
	<div class="w">
		<div class="b">
			<div class="close">X</div>
			
			<!--<div class="desc-viagem">
				<h1>Descrição Viagem</h1><br>
				<p>Código da Viagem: 001</p>
				<p>Veículo: CVX-9988</p>
				<p>Motorista: Luiz</p>
				<p>Gerente Responsável: Rafael Santos</p>
				<p>Data de partida: 02/03/14</p>
				<p>Data de chegada: 02/03/14</p>
			</div>

			<button class="btn-salvar-alteracoes">Salvar</button>-->
		</div>
	</div>
	<header>
		<div class="conteudo-cabecalho">			
			<img class="imgLogoCabecalho" src="<?php echo $assets['images']?>logo_transparent.png">
			<h1>FoodExpress</h1>
		</div>	
		<div class="logout"><p>Logout</p></div>	
	</header>
	<div class="conteudo-menu">		
		<ul>
			<li value="home"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Inicio</li>
			<li value="empresas"><img class="imgItemMenu" src="<?php echo $assets['images']?>empresa.png">Empresa
				<ul>
					<li value="novaempresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>empresa.png">Nova Empresa</li>
					<li value="mostrarempresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Empresas</li>
				</ul>
			</li>
			<li value="encomendas"><img class="imgItemMenu" src="<?php echo $assets['images']?>encomenda.png">Encomendas
				<ul>
					<li value="finalizarencomenda"><img class="imgItemMenu" src="<?php echo $assets['images']?>encomenda.png">Finalizar encomenda</li>
					<li value="mostrarencomenda"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver encomendas</li>
				</ul>
			</li>
			<li value="depositos"><img class="imgItemMenu" src="<?php echo $assets['images']?>estoque.png">Depósito
				<ul>
					<li value="novodeposito"><img class="imgItemMenu" src="<?php echo $assets['images']?>estoque.png">Novo Deposito</li>
					<li value="mostrardeposito"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Deposito</li>
				</ul>
			</li>
			<li value="fornecedores"><img class="imgItemMenu" src="<?php echo $assets['images']?>fornecedor.png">Fornecedores
				<ul>
					<li value="novofornecedor"><img class="imgItemMenu" src="<?php echo $assets['images']?>fornecedor.png">Novo Fornecedor</li>
					<li value="mostrarfornecedor"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Fornecedores</li>
				</ul>
			</li>
			<li value="funcionarios"><img class="imgItemMenu" src="<?php echo $assets['images']?>funcionario.png">Funcionários
				<ul>
					<li value="novofuncionario"><img class="imgItemMenu" src="<?php echo $assets['images']?>funcionario.png">Novo Funcionário</li>
					<li value="mostrarfuncionario"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Funcionários</li>
				</ul>
			</li>
			<li value="pagamento"><img class="imgItemMenu" src="<?php echo $assets['images']?>pagamento.png">Pagamentos
				<ul>
					<li value="mostrarpagamentopedidos"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Pagamento pedidos</li>
					<li value="mostrarpagamentoencomendas"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Pagamento encomendas</li>
				</ul>
			</li>
			<li value="pedidos"><img class="imgItemMenu" src="<?php echo $assets['images']?>pedido.png">Pedidos
				<ul>
					<li value="novopedido"><img class="imgItemMenu" src="<?php echo $assets['images']?>pedido.png">Novo Pedido</li>
					<li value="entradapedido"><img class="imgItemMenu" src="<?php echo $assets['images']?>pedido.png">Registrar Entrada</li>
					<li value="mostrarpedido"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Pedido</li>
				</ul>
			</li>
			<li value="produtos"><img class="imgItemMenu" src="<?php echo $assets['images']?>produto.png">Produtos
				<ul>
					<li value="novoproduto"><img class="imgItemMenu" src="<?php echo $assets['images']?>produto.png">Novo Produto</li>
					<li value="mostrarproduto"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Produtos</li>
				</ul>
			</li>
			<li value="viagens"><img class="imgItemMenu" src="<?php echo $assets['images']?>viagem.png">Viagens
				<ul>
					<li value="novaviagem"><img class="imgItemMenu" src="<?php echo $assets['images']?>viagem.png">Nova Viagem</li>
					<li value="entradaviagem"><img class="imgItemMenu" src="<?php echo $assets['images']?>viagem.png">Finalzar Viagem</li>
					<li value="listarviagens"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Listar Viagens</li>
				</ul>
			</li>
			<li value="veiculos"><img class="imgItemMenu" src="<?php echo $assets['images']?>veiculo.png">Veículos
				<ul>
					<li value="novoveiculo"><img class="imgItemMenu" src="<?php echo $assets['images']?>veiculo.png">Novo Veículo</li>
					<li value="mostrarveiculo"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Veículos</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="conteudo">	
		<div id="teste">	
			
			<br>	
			<h1>Bem-Vindo ao FoodExpress</h1>
			<p>A FoodExpress é uma distribuidora de alimentos criada em 2010 que tem como lema "So fast how you want!"</p>
			<p>Prezado <strong><?php echo $_SESSION['nomeUsuario'];?></strong> está conectado como <strong><?php echo $_SESSION['user'];?></strong></p>

		</div>
	</div>
</body>
</html>