$(document).ready(function(){

	$(".button-login").click(function(e){
		
		//Desativa o evento padrão do elemento
		e.preventDefault();
		
		var $login = $("[name='username']").val();
		var $senha = $("[name='password']").val();

		if($login.length == 0 || $login.length == 0){
			console.log("Um dos campos não está preenchido!");
		}
		else{

			$dados = new Object();
			$dados['username'] = $login;
			$dados['password'] = $senha;

			$.ajax({
				url: ( location.href + "index/login"),
				type: "post",
				async: true,
				data: $dados,
				cache: false
			})
			.done(function(data){
				data = $.parseJSON(data);
				if(data["resposta"] == true){
					window.location.assign(location.href + "painel");
				}
				else{
					console.log("deu ruim");
				}
			})
			.fail(function(){
				console.log("DASD");
			});
		}
	});

});