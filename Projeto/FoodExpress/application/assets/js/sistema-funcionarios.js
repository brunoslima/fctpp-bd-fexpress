$(document).ready(function(){

	/**
	 * Associa a função de cadastrar funcionário
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-funcionario", function(e){

		e.preventDefault();
	 	$dados = new Object();
	 	$dados['nome'] = $("input[name='nome']").val();
	 	$dados['salario'] = $("input[name='salario']").val();
	 	$dados['dataNascimento'] = $("input[name='dataNascimento']").val();
	 	$dados['dataContratacao'] = $("input[name='dataContratacao']").val();
	 	$dados['cargo'] = $("select[name='cargo']").val();
	 	
	 	if($("select[name='cargo']").val() == "0"){
	 		$dados['setor'] = $("input[name='setor']").val();
	 	}
	 	else if($("select[name='cargo']").val() == "1"){
	 		$dados['contato'] = $("input[name='contato']").val();
	 		$dados['login'] = $("input[name='login']").val();
	 		$dados['senha'] = $("input[name='senha']").val();
	 	}
	 	else if($("select[name='cargo']").val() == "2"){
	 		$dados['categoria'] = $("select[name='cargo']").val();
	 		$dados['codigo'] = $("input[name='codigo']").val();
	 		$dados['area'] = $("input[name='area']").val();
	 		$dados['numero'] = $("input[name='numero']").val();
	 	}
	 	else{
	 		
	 		if ($("select[name='porte']").val() == 1){
	 		 	$dados['porte'] = true;
	 		}
	 		else{
	 			$dados['porte'] = false;
	 		}
	 	}

	 	$.ajax({
			url: ( location.href + "/cadastrarFuncionario"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("funcionario cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã");
		});
	 });
});