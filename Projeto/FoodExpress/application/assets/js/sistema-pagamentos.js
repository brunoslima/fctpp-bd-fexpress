$(document).ready(function(){

	$(document).on("click", ".btn-confirmar-entradaEncomenda", function(event){

		event.preventDefault();

	 	let dados = {
	 		pagamento: $('[name="listaencomendaentrada"]').val()
	 	}

	 	$.ajax({
			url: ( location.href + "/entradaEncomenda"),
			type: "post",
			async: true,
			data: dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("Pagamento da encomenda finalizado");
		})
		.fail(function(){
			console.log("pãã pãã pãã pãã hey");
		});
	});

});