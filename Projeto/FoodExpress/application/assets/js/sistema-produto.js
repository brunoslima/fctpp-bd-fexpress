$(document).ready(function(){

	var listaProduto = {};
	/**
	 * Associa a função de cadastrar produto
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-produto", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['nomeProduto'] = $("input[name='nomeProduto']").val();	 		 	
	 	$dados['descricaoProduto'] = $("input[name='descricaoProduto']").val();
	 	$dados['idFornecedor'] = $("#forn").val();
	 	
	 	$.ajax({
			url: ( location.href + "/cadastrarProduto"),
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

	$(document).on("change",'[name="modificarproduto"]', function(){

		listaProduto.id = $(this).val();
		let id = listaProduto.id;

		if (id != 0){
			$(this).attr("disabled", true);
			recuperarDados(id, "/recuperarProduto");

			$(".modificarproduto [name='nomeProduto']").val(dadosObjeto.espec.nome);
			$(".modificarproduto [name='descricaoProduto']").val(dadosObjeto.espec.descricao);

			if (dadosObjeto.produto != null) {

				let content = `
					<div class="bloco">
					<label>Preço</label><br>
					<input type="number" min="0.01" step="0.01" name="precoProduto"><br><br>
					<label>Depósito</label><br>
					<select name="depositoProduto">

					</select></div>
				`;

				$(".modificarproduto .bloco").remove();
				$(".modificarproduto textarea").after(content);
				$('[name="depositoProduto"]').empty();
				$('[name="depositoProduto"]').append(dadosObjeto.deposito);
 			

				$(".modificarproduto [name='precoProduto']").val(parseFloat(dadosObjeto.produto.preco).toFixed(2));
				$(".modificarproduto [name='depositoProduto']").val(dadosObjeto.produto.fkDeposito);
			}
			
		}
	});

});