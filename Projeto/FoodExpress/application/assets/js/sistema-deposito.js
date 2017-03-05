$(document).ready(function(){


	var listaDeposito = {

	};
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

	$(document).on("change",'[name="modificardeposito"]', function(){
		let id = $(this).val();
		
		if (id != 0){
			$(this).attr("disabled", true);
			recuperarDados(id, "/recuperarDeposito");

			$(".modificardeposito [name='nomeDepositoModificar']").val(dadosObjeto.deposito.nome);
			$(".modificardeposito [name='descricaoDepositoModificar']").val(dadosObjeto.deposito.descricao);
		}
	});  
	 
	$(document).on("click", ".btn-modificar-deposito", function(e){
		e.preventDefault();

		let dados = {

		};
		let regra = {
			id: "",
			nome: "nome",
			descricao: ""
		};

		let excecao = {

		};

		dados['id'] = listaDeposito.id;
		dados['nome'] = $(".modificardeposito [name='nomeDepositoModificar']").val();
		dados['descricao'] = $(".modificardeposito [name='descricaoDepositoModificar']").val();

		
		resetForm(".modificardeposito");
	}); 
	 
});