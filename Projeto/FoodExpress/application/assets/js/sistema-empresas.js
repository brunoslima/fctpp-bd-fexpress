$(document).ready(function(){


	var listaEmpresa = {};	
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

	$(document).on("change",'[name="modificarempresa"]', function(){
		let id = $(this).val();
		
		if (id != 0){
			$(this).attr("disabled", true);
			recuperarDados(id, "/recuperarEmpresa");

			$(".modificarempresa [name='cnpjEmpresa']").val(dadosObjeto.empresa.cnpj);
			$(".modificarempresa [name='cnpjEmpresa']").attr("disabled", true);
			$(".modificarempresa [name='nomeEmpresa']").val(dadosObjeto.empresa.nome);
			$(".modificarempresa [name='proprietarioEmpresa']").val(dadosObjeto.empresa.proprietario);
			$(".modificarempresa [name='chaveEmpresa']").val(dadosObjeto.empresa.chaveAcesso);
			$(".modificarempresa [name='logradouroEmpresa']").val(dadosObjeto.endereco.logradouro);
			$(".modificarempresa [name='numeroEnderecoEmpresa']").val(parseInt(dadosObjeto.endereco.numero));
			$(".modificarempresa [name='bairroEmpresa']").val(dadosObjeto.endereco.bairro);
			
			$(".modificarempresa [name='estado']").val(dadosObjeto.endereco.idState);
			
			recuperarDados(dadosObjeto.endereco.idState, "/recuperarCidades");
			$(".modificarempresa [name='cidade']").empty();
			$(".modificarempresa [name='cidade']").append(dadosObjeto['listaCidades']);
			$(".modificarempresa [name='cidade']").val(dadosObjeto.endereco.idCity);
			$(".modificarempresa [name='complementoEmpresa']").val(dadosObjeto.endereco.complemento);
		}
	});

	$(document).on("click", ".btn-atualizar-empresa", function(e){
		
		e.preventDefault();
		let dados = {}

		dados['id'] = $(".modificarempresa [name='cnpjEmpresa']").val();
		dados['nome'] = $(".modificarempresa [name='nomeEmpresa']").val();
		dados['proprietario'] = $(".modificarempresa [name='proprietarioEmpresa']").val();
		dados['chave'] = $(".modificarempresa [name='chaveEmpresa']").val();
		dados['senhaantiga'] = $(".modificarempresa [name='senhaEmpresa']").val();
		dados['senhanova'] = $(".modificarempresa [name='senhaEmpresaNova']").val();
		dados['logradouro'] = $(".modificarempresa [name='logradouroEmpresa']").val();
		dados['numero'] = $(".modificarempresa [name='numeroEnderecoEmpresa']").val();
		dados['bairro'] = $(".modificarempresa [name='bairroEmpresa']").val();
		dados['estado'] = $(".modificarempresa [name='estado']").val();
		dados['cidade'] = $(".modificarempresa [name='cidade']").val();
		dados['complemento'] = $(".modificarempresa [name='complementoEmpresa']").val();

		console.log(dados);

		resetForm(".modificarempresa");
	});
});