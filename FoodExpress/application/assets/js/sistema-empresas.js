$(document).ready(function(){

	/**
	 * Associa a função de cadastrar empresa
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-empresa", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['cnpjEmpresa'] = $("input[name='cnpjEmpresa']").val();
	 	$dados['proprietarioEmpresa'] = $("input[name='proprietarioEmpresa']").val();
	 	$dados['nomeEmpresa'] = $("input[name='nomeEmpresa']").val();
	 	$dados['chaveEmpresa'] = $("input[name='chaveEmpresa']").val();
	 	$dados['senhaEmpresa'] = $("input[name='senhaEmpresa']").val();
	 	$dados['numeroEmpresa'] = $("input[name='numeroEmpresa']").val();
	 	$dados['logradouroEmpresa'] = $("input[name='logradouroEmpresa']").val();
	 	$dados['numeroEnderecoEmpresa'] = $("input[name='numeroEnderecoEmpresa']").val();
	 	$dados['bairroEmpresa'] = $("input[name='bairroEmpresa']").val();
	 	$dados['complementoEmpresa'] = $("input[name='complementoEmpresa']").val();
	 	$dados['cidadeEmpresa'] = $("select[name='cidade']").val();

	 	if($("select[name='cidade']").val() == "0"){
	 		$dados['nomeCidadeEmpresa'] = $("input[name='nomeCidadeEmpresa']").val();
	 		$dados['estadoCidadeEmpresa'] = $("input[name='estadoCidadeEmpresa']").val();
	 		$dados['paisCidadeEmpresa'] = $("input[name='paisCidadeEmpresa']").val();
	 	}

	 	$.ajax({
			url: ( location.href + "/cadastrarEmpresa"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("empresa cadastrada com sucesso!");
		})
		.fail(function(){
			console.log("pãã pãã pãã hey");
		});
	});
});