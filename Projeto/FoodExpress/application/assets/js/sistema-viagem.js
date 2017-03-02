$(document).ready(function(){


	let listaEncomendas;
	/**
	 * Associa a função de cadastrar veículo
	 * ao respectivo botão
	 */
	
	//tem que terminar
	 $(document).on("click", ".btn-finalizar-viagem", function(e){

	 	e.preventDefault();
	 	let dados = {
	 		lista: listaEncomendas,
	 		motorista: $("[name='motoristaviagem']").val(),
	 		veiculo: $('[name="veiculoviagem"]').val(),
	 		dataPartida: $('[name="datapartida"]').val(),
	 		dataChegada: $('[name="datachegada"]').val(),
	 		nomeEmpresa: $('[name="empresaviagem"]').val(),
	 		descricao: $('[name="descricaoviagem"]').val()
	 	};
	 	
	 	$.ajax({
			url: ( location.href + "/finalizarViagem"),
			type: "post",
			async: true,
			data: dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("veiculo cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã");
		});
		
	 });

	$(document).on("change", '[name="empresaviagem"]', function(e){

	 	e.preventDefault();
	 	let dados = {
	 		nome: $(this).val()
	 	};
	 	
	 	var endereco = location.href;
		endereco = endereco.split("/");
		var final = "http://" + endereco[2] + "/FoodExpress/gui/listarEncomendasViagem";
	 	$.ajax({
			url: (final),
			type: "post",
			async: true,
			data: dados,
			cache: false
		})
		.done(function(data){

			console.log(data);
			$("#listaEncomendasViagem").slideOut();
			$("#listaEncomendasViagem tbody").empty();
			$("#listaEncomendasViagem tbody").append(data['pagina']);
			$("#listaEncomendasViagem").slideIn();

			listaEncomendas = data['encomendas'];
		})
		.fail(function(){
			console.log("pãã");
		});
		
	});


});