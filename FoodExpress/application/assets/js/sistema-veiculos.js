$(document).ready(function(){

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

});