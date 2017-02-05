$(document).ready(function(){

	/**
	 * Associa a função de cadastrar um novo deposito
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
			console.log(data);
			console.log("Deposito cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã pãã pãã pãã hey");
		});

	});
	 
});