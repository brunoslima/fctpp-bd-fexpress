<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>FoodExpress</title>
	<script type="text/javascript" src="<?php echo $assets['script']?>jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $assets['script']?>homepage.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $assets['style']?>loginStyle.css"/>
</head>
<body>
	<header>
		<div class="logo">
			<img src="<?php echo $assets['images']?>logo_transparent.png">
		</div>
	</header>
	<div class="bloco-intermediario">
		
		<div class="conteudo">
			<div class="titulo-pagina">
				<h1>FoodExpress</h1>
				<p>so fast how you want!</p>
			</div>
			
			<div class="sistema-pagina">
				<form method="post" action="">
					<input placeholder="Identificação" autocomplete="off" type="email" name="username"/><br>
					<input placeholder="Senha" type="password" name="password" minlength="5" maxlength="20" /><br>
					<button class="button-login">Login</button>
					<p class="message ax">Login ou senha incorretos !</p>
					<p class="message bx">Campos preenchidos incorretamente !</p>
				</form>
			</div>
		</div>
		<div class="efeito"></div>
		<div class="bloco-animacao">
			<div class="animacao-paisagem"></div>
			<div class="animacao-carro01"></div>
			<div class="animacao-carro02"></div>
			<div class="animacao-carro03"></div>
		</div>
	</div>
	<footer>
		<!--<div class="social">
			<a href=""><img src="<?php echo $assets['images']?>face.png" width="30" height="30"/></a>
			<a href=""><img src="<?php echo $assets['images']?>youtube.png" width="30" height="30"/></a>
		</div>-->
		<div class="copyright">
			<p>@Copyright 2016. All rights reserved.</p>
		</div>
	</footer>
</body>

</html>