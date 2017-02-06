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

	 $(document).on("change", "select[name='estado']", function(){

		$id = $("select[name='estado']").val();
		$dados = new Object();

		$dados['id'] = $id;
		var endereco = location.href;
		endereco = endereco.split("/");
		var final = "http://" + endereco[2] + "/FoodExpress/gui/listarCidades";
		$.ajax({
			url: ( final),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			
			$("select[name='cidade']").empty();
			$("select[name='cidade']").append(data);

		})
		.fail(function(){
			console.log("pãã");
		});
	});
});