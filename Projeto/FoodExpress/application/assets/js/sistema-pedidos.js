$(document).ready(function(){

	/**
	 * Associa a função de cadastrar um Pedido
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-pedido", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['descricaoPagamento'] = $("input[name='descricaoPagamento']").val();

	 	$.ajax({
			url: ( location.href + "/cadastrarPedido"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("Pedido cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã pãã pãã pãã hey");
		});
	});
});