$(document).ready(function(){

	var listaVeiculo = {};
	/**
	 * Associa a função de cadastrar veículo
	 * ao respectivo botão
	 */
	 $(document).on("click", ".btn-cadastrar-veiculo", function(e){

	 	e.preventDefault();
	 	$dados = new Object();
	 	$dados['placaVeiculo'] = $("input[name='placaVeiculo']").val();	 		 	
	 	$dados['anoVeiculo'] = $("input[name='anoVeiculo']").val();
	 	$dados['modeloVeiculo'] = $("input[name='modeloVeiculo']").val();
	 	$dados['capacidadeVeiculo'] = $("input[name='capacidadeVeiculo']").val();
	 	
	 	$.ajax({
			url: ( location.href + "/cadastrarVeiculo"),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			console.log(data);
			console.log("veiculo cadastrado com sucesso!");
		})
		.fail(function(){
			console.log("pãã");
		});
		
	 });


	 $(document).on("change",'[name="modificarveiculo"]', function(){

		listaVeiculo.id = $(this).val();
		let id = listaVeiculo.id;

		if (id != 0){
			$(this).attr("disabled", true);
			recuperarDados(id, "/recuperarVeiculo");

			$(".modificarveiculo [name='placa']").val(dadosObjeto.veiculo.placa);
			$(".modificarveiculo [name='ano']").val(dadosObjeto.veiculo.ano);
			$(".modificarveiculo [name='modelo']").val(dadosObjeto.veiculo.modelo);
			$(".modificarveiculo [name='capacidade']").val(dadosObjeto.veiculo.capacidade);

			
		}
	});


	$(document).on("click", ".btn-modificar-veiculo", function(e){
		
		e.preventDefault();
		let dados ={};
		
		dados['id'] = listaVeiculo.id;
		dados['placa'] = $(".modificarveiculo [name='placa']").val();
		dados['ano'] = $(".modificarveiculo [name='ano']").val();
		dados['modelo'] = $(".modificarveiculo [name='modelo']").val();
		dados['capacidade'] = $(".modificarveiculo [name='capacidade']").val();

		console.log(dados);

		resetForm(".modificarveiculo");
	});

});