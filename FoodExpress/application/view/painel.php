<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8"/>
	
	<title>FoodExpress</title>

	<script type="text/javascript" src="<?php echo $assets['script']?>jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>datatables.js"></script>
	
	<script type="text/javascript" src="<?php echo $assets['script']?>painel-usuario.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-encomendas.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-estoque.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-fornecedores.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-funcionarios.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pagamentos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pedidos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-veiculos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-empresas.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>painelStyle.css">	
	<link rel="shortcut icon" href="<?php echo $assets['images']?>logo_transparent.png">	

</head>
<body>
	<header>
		<div class="conteudo-cabecalho">			
			<img class="imgLogoCabecalho" src="<?php echo $assets['images']?>logo_transparent.png"; >
			<h1>FoodExpress</h1>
		</div>	
		<div class="logout"><p>Logout</p></div>	
	</header>
	<div class="conteudo-menu">		
		<ul>
			<li value="empresas"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Empresa
				<ul>
					<li value="novaempresa"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Nova Empresa</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Ver empresa</li>
				</ul>
			</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Encomendas
				<ul>
					<li value="novaencomenda"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Nova Encomenda</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">sub-menu 2</li>
				</ul>
			</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Estoque</li>
			<li value="fornecedores"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Fornecedores
				<ul>
					<li value="novofornecedor"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Novo Fornecedor</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Ver Fornecedores</li>
				</ul>
			</li>
			<li value="funcionarios"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Funcionários
				<ul>
					<li value="novofuncionario"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Novo Funcionário</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Ver Funcionários</li>
				</ul>
			</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Pagamentos</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Pedidos</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Rota de Viagens</li>
			<li value="veiculos"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Veículos
				<ul>
					<li value="novoveiculo"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Novo Veículo</li>
					<li value="mostrarveiculo"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Ver Veículos</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="conteudo">	
		<div id="teste">	
			
			<br>	
			<h1>Bem-Vindo ao FoodExpress</h1>
			<p>A FoodExpress é uma distribuidora de alimentos criada em 2010. So fast how you want!</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. </p>

			<h1>Forms</h1>
			<form action="">
				<input placeholder="Email" type="text" name=""/>
				<input placeholder="Senha" type="password" name=""/>
				<select>
					<optgroup> 
						<option>França</option>
						<option>Portugal</option>
						<option>Alemanha</option>
						<option>País de Gales</option>
					</optgroup>
				</select>
				<textarea name="" id=""></textarea>

			</form>
		
		</div>
	</div>
</body>
</html>