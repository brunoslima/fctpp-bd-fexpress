$(document).ready(function(){


	let ArraylistaEncomendas;
	/**
	 * Associa a função de cadastrar veículo
	 * ao respectivo botão
	 */
	
	//tem que terminar
	 $(document).on("click", ".btn-finalizar-viagem", function(e){

	 	e.preventDefault();
	 	let dados = {
	 		lista: ArraylistaEncomendas,
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
			console.log("Viagem cadastrada com sucesso!");
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
			
			data = $.parseJSON(data);
			$("#listaEncomendasViagem").slideUp();
			$("#listaEncomendasViagem tbody").empty();
			$("#listaEncomendasViagem tbody").append(data["pagina"]);
			$("#listaEncomendasViagem").slideDown();

			ArraylistaEncomendas = data.encomendas;
		})
		.fail(function(){
			console.log("pãã");
		});
		
	});


	$(document).on("click", ".btn-confirmar-entradaViagem", function(event){

		event.preventDefault();

	 	let dados = {
	 		viagem: $('[name="listaviagementrada"]').val(),
	 	}

	 	$.ajax({
			url: ( location.href + "/entradaViagem"),
			type: "post",
			async: true,
			data: dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
		})
		.fail(function(){
			console.log("pãã pãã pãã pãã hey");
		});
	});


});