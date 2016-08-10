$(document).ready(function(){

	/**
	 * Associa a função de cadastrar fornecedor
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-fornecedor", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['cnpjFornecedor'] = $("input[name='cnpjFornecedor']").val();
	 	$dados['nomeFornecedor'] = $("input[name='nomeFornecedor']").val();
	 	$dados['emailFornecedor'] = $("input[name='emailFornecedor']").val();
	 	$dados['tipoFornecedor'] = $("select[name='tipoFornecedor']").val();
	 	$dados['codigoFornecedor'] = $("input[name='codigoFornecedor']").val();
	 	$dados['areaFornecedor'] = $("input[name='areaFornecedor']").val();
	 	$dados['numeroFornecedor'] = $("input[name='numeroFornecedor']").val();
	 	$dados['logradouroFornecedor'] = $("input[name='logradouroFornecedor']").val();
	 	$dados['numeroEnderecoFornecedor'] = $("input[name='numeroEnderecoFornecedor']").val();
	 	$dados['bairroFornecedor'] = $("input[name='bairroFornecedor']").val();
	 	$dados['complementoFornecedor'] = $("input[name='complementoFornecedor']").val();
	 	$dados['cidadeFornecedor'] = $("select[name='cidade']").val();

	 	if($("select[name='cidade']").val() == "0"){
	 		$dados['nomeCidadeFornecedor'] = $("input[name='nomeCidadeFornecedor']").val();
	 		$dados['estadoCidadeFornecedor'] = $("input[name='estadoCidadeFornecedor']").val();
	 		$dados['paisCidadeFornecedor'] = $("input[name='paisCidadeFornecedor']").val();
	 	}

	 	$.ajax({
			url: ( location.href + "/cadastrarFornecedor"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("fornecedor cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã");
		});
	});
});