<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>FoodExpress</title>
	<script type="text/javascript" src="<?php echo $assets['script']?>jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>painel-usuario.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-encomendas.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-estoque.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-fornecedores.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-funcionarios.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pagamentos.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>sistema-pedidos.js"></script>
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
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Encomendas
				<ul>
					<li value="novaencomenda"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Nova Encomenda</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">sub-menu 2</li>
				</ul>
			</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Estoque</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Fornecedores</li>
			<li value="funcionarios"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Funcionários
				<ul>
					<li value="novofuncionario"><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Novo Funcionário</li>
					<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">sub-menu 2</li>
				</ul>
			</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Pagamentos</li>
			<li><img class="imgItemMenu" src="<?php echo $assets['images']?>home.png">Pedidos</li>
		</ul>

	</div>
	<div class="conteudo">	
		<div id="teste">	
			
			<br>	
			<h1>Título</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. </p>
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