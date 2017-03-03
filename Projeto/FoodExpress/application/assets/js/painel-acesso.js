var dadosObjeto = {};

function recuperarDados(id, url){

	$.ajax({
		url: ( location.href + url),
		type: "post",
		async: false,
		data:  {
			id: id
		},
		cache: false
	})
	.done(function(data){
		data = $.parseJSON(data);
		get(data);
	})
	.fail(function(){
		console.log("pãã");
	});

}

function get(data){
	for(x in data){
		dadosObjeto[x] = data[x];
	}
}


$(document).ready(function(){


	$(document).on("click",".w > .b > .close",function(){

		$(".w").fadeOut();
	});

	$(document).on("click", ".panel-viagem", function(){

		let id = parseInt($(this).attr("data-id"));
		recuperarDados(id, "/recuperarViagem");
		let content = `
			<div class="desc-viagem">
				<h1>Descrição Viagem</h1><br><br>
				<p class="largura">`+dadosObjeto.descricao+`</p><br>
				<p>Código da Viagem: `+id+`</p>
				<p>Veículo: `+dadosObjeto.veiculo['0'].placa+`</p>
				<p>Motorista: `+dadosObjeto.motorista+`</p>
				<p>Gerente Responsável: `+dadosObjeto.gerente+`</p>
				<p>Data de partida: `+dadosObjeto.partida+`</p>
				<p>Data de chegada: `+dadosObjeto.chegada+`</p>
				<br><br>
				<p>Endereço:</p>
				<p>`+ dadosObjeto.dados['0'].logradouro +`, `+dadosObjeto.dados['0'].numero +' - '+dadosObjeto.dados['0'].bairro+`</p>
				<p>Cidade: `+dadosObjeto.dados['0'].cidade+`</p>
				<p>Estado: `+dadosObjeto.dados['0'].estado+`</p>
			</div>
		`;

		$(".w > .b").empty();
		$(".w > .b").append("<div class='close'>X</div>");
		$(".w > .b").append(content);
		
		$(".w").fadeIn();

	});

});




