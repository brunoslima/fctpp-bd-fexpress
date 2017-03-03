<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8"/>
	
	<title>FoodExpress</title>

	<script type="text/javascript" src="<?php echo $assets['script']?>jquery-3.1.1.min.js"></script>
	
	<script type="text/javascript" src="<?php echo $assets['script']?>painel-usuario.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-encomendas.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-deposito.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-fornecedores.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-funcionarios.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pagamentos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pedidos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-veiculos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-produto.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-empresas.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>painelStyle.css">	
	<link rel="shortcut icon" href="<?php echo $assets['images']?>logo_transparent.png">	

</head>
<body>
	<header>
		<div class="conteudo-cabecalho">			
			<img class="imgLogoCabecalho" src="<?php echo $assets['images']?>logo_transparent.png">
			<h1>FoodExpress</h1>
		</div>	
		<div class="logout"><p>Logout</p></div>	
	</header>
	<div class="conteudo-menu">		
		<ul>
			<li value="homeEmpresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Inicio</li>
			<li value="encomendas"><img class="imgItemMenu" src="<?php echo $assets['images']?>encomenda.png">Encomendas
				<ul>
					<li value="novaencomenda"><img class="imgItemMenu" src="<?php echo $assets['images']?>encomenda.png">Nova encomenda</li>
					<li value="mostrarencomendaempresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver encomendas</li>
				</ul>
			</li>
			<li value="pagamento"><img class="imgItemMenu" src="<?php echo $assets['images']?>pagamento.png">Pagamentos
				<ul>
					<li value="mostrarpagamentoempresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Pagamento</li>
				</ul>
			</li>
			<li value="produtos"><img class="imgItemMenu" src="<?php echo $assets['images']?>produto.png">Produtos
				<ul>
					<li value="mostrarproduto"><img class="imgItemMenu" src="<?php echo $assets['images']?>relatorio.png">Ver Produtos</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="conteudo">	
		<div id="teste">	
			
			<br>	
			<h1>Bem-Vindo ao FoodExpress</h1>
			<p>A FoodExpress é uma distribuidora de alimentos criada em 2010 que tem como lema "So fast how you want!"</p>
			<p>Prezado <strong><?php echo $_SESSION['nomeEmpresa'];?></strong> está conectado como <strong>uma de nossas empresas parceiras</strong></p>

		</div>
	</div>
</body>
</html>