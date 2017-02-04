$(document).ready(function(){

	/**
	 * Associa a função de cadastrar empresa
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-deposito", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['nomeDeposito'] = $("input[name='nomeDeposito']").val();
	 	$dados['descricaoDeposito'] = $("textarea[name='descricaoDeposito']").val();

	 	$.ajax({
			url: ( location.href + "/addDeposito"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
		})
		.fail(function(){
			console.log("pãã pãã pãã hey");
		});
	});
});