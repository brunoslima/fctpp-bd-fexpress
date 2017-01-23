$(document).ready(function(){

	/**
	 * Efetua o logout do usuário atual
	 * 
	 */
	$(".logout").click(function(e){
		
		//Desativa o evento padrão do elemento
		e.preventDefault();
		$dados = new Object();

		//console.log(location.href);
		$.ajax({
			url: ( location.href + "/logout"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			
			var url = location.href;
			url = url.split("/");
			window.location.assign("http://" + url[2] + "/FoodExpress");
		})
		.fail(function(){
			console.log("pãã");
		});
	});

	$('.conteudo-cabecalho').click(function(){

		if($('.conteudo-menu').css("left") != "-500px"){
			
			$('.conteudo-menu').animate({
				"left": "-500px"
			});
			$(".conteudo").animate({
				"width": $(document).width() - 80,
				
			});

			$("footer").animate({
				"width":"100%",
				"left":"0%"
			});
		}
		else{
	
			$('.conteudo-menu').animate({
				"left": "0px"
			});

			$(".conteudo").animate({
				"width":$(document).width()*0.82 - 80,
			});
			$("footer").animate({
				"width":"82%",
				"left":"18%"
			});
		}
	});


	$(".conteudo-menu ul > li").click(function(){

		//uma ideia legal é no switch case escolher a url em que
		// se carregará o conteúdo da pagina
		//ex: http://localhost/FoodExpress/gui/novaencomenda
		//pega esse conteudo por ajax e damos uma append na div conteudo, sem esquecer de remover o anterior
		//top!!
		var url;

		//console.log($(this).attr("value"));

		switch($(this).attr("value")){

			case "novaencomenda":
				url = "/gui/novaencomenda";
				break;

			case "novofuncionario":
				url = "/gui/novofuncionario";
				break;

			case "novofornecedor":
				url = "/gui/novofornecedor";
				break;

			case "novoveiculo":
				url = "/gui/novoveiculo";
				break;

			case "mostrarveiculo":
				url = "/gui/mostrarveiculo";
				break;

			case "novaempresa":
				url = "/gui/novaempresa";
				break;
				
			default:

				//console.log("você está agindo de má fé!");
				return;
		}

		var endereco = location.href;
		endereco = endereco.split("/");
		var final = "http://" + endereco[2] + "/FoodExpress" + url;
		var $dados = new Object();
		$.ajax({
			url: ( final),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			
			$(".conteudo").empty();
			$(".conteudo").append(data);

		})
		.fail(function(){
			console.log("pãã");
		});
	});

	/*$(document).on("[value=mostrarveiculo]", "click", function(){

		$('#datatables').DataTable();
	});*/

	$(document).on("click", "select[name='cargo']", function(){

		if($("select[name='cargo']").val() == "0"){
			$(".opt0").css("display","block");
			$(".opt1").css("display","none");
			$(".opt2").css("display","none");
			$(".opt3").css("display","none");
		}
		else if($("select[name='cargo']").val() == "1"){
			$(".opt0").css("display","none");
			$(".opt1").css("display","block");
			$(".opt2").css("display","none");
			$(".opt3").css("display","none");
		}
		else if($("select[name='cargo']").val() == "2"){
			$(".opt0").css("display","none");
			$(".opt1").css("display","none");
			$(".opt2").css("display","block");
			$(".opt3").css("display","none");
		}
		else{
			$(".opt0").css("display","none");
			$(".opt1").css("display","none");
			$(".opt2").css("display","none");
			$(".opt3").css("display","block");
		}
	});

});