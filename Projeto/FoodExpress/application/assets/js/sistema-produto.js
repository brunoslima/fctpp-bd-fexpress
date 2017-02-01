$(document).ready(function(){

	/**
	 * Associa a função de cadastrar produto
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-produto", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['nomeProduto'] = $("input[name='nomeProduto']").val();	 		 	
	 	$dados['descricaoProduto'] = $("input[name='descricaoProduto']").val();
	 	
	 	$.ajax({
			url: ( location.href + "/cadastrarVeiculo"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("Produto cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã");
		});
		
	 });

});