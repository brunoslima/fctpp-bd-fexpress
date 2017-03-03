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

////////////////////////////////////////
////////////////////////////////////////
///Mapa
///

var map;

//Localização da empresa FoodExpress
var minhaLocalizacao = "Av. Joaquim Constantino, 1000 - Vila Nova Prudente, Pres. Prudente - SP";
//Localização do destino
var destino = "Av. Padre Jorge Summerer, 64 - Centro, Martinópolis - São Paulo";



function inicializarMapa() {
					
	//Localização da empressa FoodExpress em latitude e longitude
	var localizacao = new google.maps.LatLng(-22.1453755,-51.3992022);

	//Serviço de rota da API Google Maps
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();

	//Caracteristicas do mapa
	var mapOptions = {
		center: localizacao,
		zoom: 10,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	//Criando o mapa
	map = new google.maps.Map(document.getElementById('map'), mapOptions);
		    		
	//Caracteristicas do marcador
	//var image = 'application/assets/css/images/marker-orange.png';
	var marker = new google.maps.Marker({
    	position: localizacao,
    	title:"FoodExpress",
    		
	});


	//Adicionando a rota ao mapa
	directionsDisplay.setMap(map);

	calcularRota(directionsService, directionsDisplay);

}//Fim da função de inicialização

function calcularRota(directionsService, directionsDisplay) {
  					
  	var modoDeViagem = "DRIVING";
	var request = {
		origin: minhaLocalizacao,
		destination: destino,
				      
		travelMode: google.maps.TravelMode[modoDeViagem]
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
}//Fim da função de calculo de rota


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

				<div id="map"></div>
			</div>
		`;

		//"Av. Padre Jorge Summerer, 64 - Centro, Martinópolis - São Paulo"
		destino = dadosObjeto.dados['0'].logradouro +', '+dadosObjeto.dados['0'].numero +' - '+dadosObjeto.dados['0'].bairro + ', ' + dadosObjeto.dados['0'].cidade + " - " + dadosObjeto.dados['0'].estado;

		console.log(destino);
		$(".w > .b").empty();
		$(".w > .b").append("<div class='close'>X</div>");
		$(".w > .b").append(content);
		inicializarMapa();
		$(".w").fadeIn();

	});

});




