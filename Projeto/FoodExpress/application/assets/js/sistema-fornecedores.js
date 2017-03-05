$(document).ready(function(){


	var listaFornecedor = {};
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

	 $(document).on("change",'[name="modificarfornecedor"]', function(){
		let valor = ($(this).val()).split(" ");
		listaFornecedor.id=parseInt(valor[1]);
		let id = listaFornecedor.id;
		if (id != 0){
			$(this).attr("disabled", true);
			recuperarDados(id, "/recuperarFornecedor");

			$(".modificarfornecedor [name='nome']").val(dadosObjeto.fornecedor.nome);
			$(".modificarfornecedor [name='email']").val(dadosObjeto.fornecedor.email);
			$(".modificarfornecedor [name='codigo']").val(dadosObjeto.fornecedor.codigo);
			$(".modificarfornecedor [name='area']").val(dadosObjeto.fornecedor.area);
			$(".modificarfornecedor [name='numero']").val(dadosObjeto.fornecedor.numero);
			$(".modificarfornecedor [name='logradouro']").val(dadosObjeto.endereco.logradouro);
			$(".modificarfornecedor [name='numeroEndereco']").val(dadosObjeto.endereco.numero);
			$(".modificarfornecedor [name='bairro']").val(dadosObjeto.endereco.bairro);
			$(".modificarfornecedor [name='complemento']").val(dadosObjeto.endereco.complemento);
			$(".modificarfornecedor [name='estado']").val(dadosObjeto.endereco.idState);
			recuperarDados(dadosObjeto.endereco.idState, "/recuperarCidades");
			$(".modificarfornecedor [name='cidade']").empty();
			$(".modificarfornecedor [name='cidade']").append(dadosObjeto['listaCidades']);
			$(".modificarfornecedor [name='cidade']").val(dadosObjeto.endereco.idCity);
		}
	}); 

	 $(document).on("click", ".btn-modificar-fornecedor", function(e){
		e.preventDefault();

		let dados = {

		};
		let regra = {

		};

		let excecao = {

		};

		dados['id'] = listaFornecedor.id;
		dados['nome'] = $(".modificarfornecedor [name='nome']").val();
		dados['email'] = $(".modificarfornecedor [name='email']").val();
		dados['codigo'] = $(".modificarfornecedor [name='codigo']").val();
		dados['area'] = $(".modificarfornecedor [name='area']").val();
		dados['numero'] = $(".modificarfornecedor [name='numero']").val();
		dados['logradouro'] = $(".modificarfornecedor [name='logradouro']").val();
		dados['numeroEndereco'] = $(".modificarfornecedor [name='numeroEndereco']").val();
		dados['bairro'] = $(".modificarfornecedor [name='bairro']").val();
		dados['complemento'] = $(".modificarfornecedor [name='complemento']").val();
		dados['estado'] = $(".modificarfornecedor [name='estado']").val();
		dados['cidade'] = $(".modificarfornecedor [name='cidade']").val();

		regra['id'] = "";
		regra['nome'] = "nome";
		regra['email'] = "email";
		regra['codigo'] = "int";
		regra['area'] = "int";
		regra['numero'] = "int";
		regra['logradouro'] = "";
		regra['numeroEndereco'] = "int";
		regra['bairro'] = "";
		regra['complemento'] = "";
		regras['estado'] = "";
		regra['cidade'] = "";


		
		resetForm(".modificarfornecedor");
	});
});