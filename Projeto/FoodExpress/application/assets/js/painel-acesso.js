var dadosObjeto = {};
var geocoder;

function enviarDados(dados, url){

	$.ajax({
		url: ( location.href + url),
		type: "post",
		async: true,
		data:  dados,
		cache: false
	})
	.done(function(data){
		console.log(data);
		data = $.parseJSON(data);
		mensagem(data.resposta);
	})
	.fail(function(){
		console.log("pãã");
	});

}

function mensagem(resposta){

	if(resposta){
		$(".sucesso").fadeIn();
		setTimeout(function(){
			$(".sucesso").fadeOut();
		}, 3000);
	}
	else{
		$(".falha").fadeIn();
		setTimeout(function(){
			$(".falha").fadeOut();
		}, 3000);
	}
}

function recuperarDados(dados, url){

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

function resetForm(selector) {
    // seleciona o form a ser resetado
    var form = document.querySelector(selector);

    // limpa todos os inputs do tipo text, password, etc...
    var inputs = form.querySelectorAll('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'checkbox' && inputs[i].type != 'radio') {
            inputs[i].value = '';
            inputs[i].disabled=false;
        }
    }

    // limpa todas as textareas
    var textarea = form.querySelectorAll('textarea');
    for (var i = 0; i < textarea.length; i++) {
        textarea[i].value = '';
        textarea[i].disabled=false;
    }

    // desmarca todos os checkboxes e radios
    inputs = form.querySelectorAll('input[type=checkbox], input[type=radio]');
    for (i = 0; i < inputs.length; i++) {
        inputs[i].checked = false;
        inputs[i].disabled=false;
    }

    // seleciona a primeira opcao de todos os selects
    var selects = form.querySelectorAll('select');
    for (i = 0; i < selects.length; i++) {
        var options = selects[i].querySelectorAll('option');
        if (options.length > 0) {
            selects[i].value = options[0].value;
            selects[i].disabled=false;
        }
    }
}



function placa( placa ){  var er = /[a-z]{3}-?\d{4}/gim;  er.lastIndex = 0;  return er.test( placa );}

function validar(dados, regra, excecao) {

    for(x in dados){

    	
    	for(a in excecao){
    		if(excecao[a] == x) {
    			continue;
    		}
    	}

    
    	if(dados[x] == ""){
    		return {validado:false, incompleto:true};
    	}

    	try{

    		switch(regra[x]){

	    		case "nome":

	    			var reTipo = /[A-z][ ][A-z]/;
	    			if(!reTipo.test(dados[x])){

	    				return {validado:false, incompleto:false};
	    			}

	    			break;

	    		case "int":

	    			dados[x] = parseInt(dados[x]);
	    			break;

	    		case "dinheiro":
	    			dados[x] = parseFloat(dados[x]).toFixed(2);
	    			break;

	    		case "float":
	    			dados[x] = parseFloat(dados[x]);
	    			break;

	    		case "ano":

	    			if(dados[x].length != 4) return {validado:false, incompleto:false};

	    			break;

	    		case "placa":
	    			if(!placa(dados[x])) return {validado:false, incompleto:false};
	    			break;

	    		case "email":
	    			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    			if(!re.test(dados[x])) return {validado:false, incompleto:false};
	    			break;

    		}
    	}
    	catch(e){

    		return {validado:false, incompleto:false};
    	}
    }

    return {validado:true};
}

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

function get(data){
	for(x in data){
		dadosObjeto[x] = data[x];
	}
}

function format(inputDate){
    var date = new Date(inputDate);
    if (!isNaN(date.getTime())) {
        // Months use 0 index.
        return (date.getDate()+1) + '/' + (date.getMonth()+1) + '/' + date.getFullYear();
    }
}


////////////////////////////////////////
////////////////////////////////////////
///Mapa
///

var map;
var mapLugar;	
//Localização da empresa FoodExpress
var minhaLocalizacao = "Av. Joaquim Constantino, 1000 - Vila Nova Prudente, Pres. Prudente - SP";
//Localização do destino
var destino = "";



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

//////////////////////////////////////////////////////////////
var map;
var geocoder;
function initMap() {
  map = new google.maps.Map(document.getElementById('mapLugar'), {
    zoom: 8,
    center: {lat: -34.397, lng: 150.644}
  });
  geocoder = new google.maps.Geocoder();

  /*document.getElementById('submit').addEventListener('click', function() {
    geocodeAddress(geocoder, map);
  });*/
}

function geocodeAddress(geocoder, resultsMap, address) {
  
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

/////////////////////////////
$(document).ready(function(){


	$(document).on("click",".w > .b > .close",function(){

		$(".w").fadeOut();
	});

	//mostrar viagem
	$(document).on("click", ".panel-viagem", function(){

		let id = parseInt($(this).attr("data-id"));
		recuperarDados(id, "/recuperarViagem");
		let content = `
			<div class="desc-viagem">
				<h1>Descrição Viagem</h1><br><br>
				<p class="largura">`+dadosObjeto.descricao+`</p><br>
				<p>Código da Viagem: `+id+`</p>
				<p>Veículo: `+dadosObjeto.veiculo+`</p>
				<p>Motorista: `+dadosObjeto.motorista+`</p>
				<p>Gerente Responsável: `+dadosObjeto.gerente+`</p>
				<p>Data de partida: `+dadosObjeto.partida+`</p>
				<p>Data de chegada: `+dadosObjeto.chegada+`</p>
				<br><br>
				<p><b>Endereço</b></p>
				<p>Logradouro: `+ dadosObjeto.dados['0'].logradouro +`, `+dadosObjeto.dados['0'].numero +' - '+dadosObjeto.dados['0'].bairro+`</p>
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


	//mostrar funcionario
	$(document).on("click", ".panel-func", function(){

		let lista = {};
		lista['id'] = $(this).attr('data-id');
		lista['cargo'] = $(this).attr('data-type');

		recuperarDados(lista, "/recuperarFuncionario");


		let content = `
			<div class='desc-funcionario'>
				<h1>Descrição Funcionário</h1>
				<br>
				<p>Código de Funcionário: ${dadosObjeto['func']['idfuncionario']}</p><br />
				<p>Nome: ${dadosObjeto['func']['nome']}</p>
				<p>Salário: R$ ${parseFloat((dadosObjeto['func']['salario'])).toFixed(2)}</p>
				<br />
				<p>Data de Contratação: ${format(dadosObjeto['func']['dataContratacao'])}</p>
				<p>Data de Nascimento: ${format(dadosObjeto['func']['dataNascimento'])}</p><br /><br />
		`;

		if (lista['cargo'] == "Auxiliar de Limpeza") {

			content += `<p>Setor Responsável: ${dadosObjeto.outro.setor}</p>`;
		}
		else if(lista['cargo'] == "Gerência") {
			content += `<p>E-mail de Contato: ${dadosObjeto.outro.email}</p>`;
		}
		else if (lista['cargo'] == "Motorista") {
			content += `<p>Categoria de Habilitação: ${dadosObjeto.outro.categoriaHabilitacao}</p><br />
				<p>Telefone: +${dadosObjeto.outro.codigo} ${dadosObjeto.outro.area} ${dadosObjeto.outro.numero}</p>
				<p>Status: ${(dadosObjeto.outro.disponivel == 1 ? "Disponível" : "Ocupado")}</p>
			`;
		}
		else{
			content += `<p>Habilitado a porte de arma: ${(dadosObjeto.outro.porteArma == 1 ? "Autorizado" : "Não Autorizado")}</p>`;
		}

		content += '</div>'

		$(".w > .b").empty();
		$(".w > .b").append("<div class='close'>X</div>");
		$(".w > .b").append(content);

		$(".w").fadeIn();
	});

	$(document).on("click",".panel-empresa", function(){


		let id = $(this).attr('data-cnpj');

		recuperarDados(id, "/recuperarEmpresa");
		let cnpj = dadosObjeto.empresa.cnpj+'';

		let content = `
			<div class='desc-empresa'>
				<h1>Descrição Empresa</h1><br />
				<p>Cadastro Nacional de Pessoa Jurídica: ${cnpj.substring(0,8)}/${cnpj.substring(8,12)}-${cnpj.substring(12,14)}</p>
				<br /><p>Nome do Proprietário: ${dadosObjeto.empresa.proprietario}</p>
				<p>Nome da Empresa: ${dadosObjeto.empresa.nome}</p>
				<br /><br />
				<p><b>Endereço</b></p>
				<p>Logradouro: ${dadosObjeto.endereco.logradouro}, ${dadosObjeto.endereco.numero} - ${dadosObjeto.endereco.bairro}</p>
				<p>Complemento: ${dadosObjeto.endereco.complemento}</p>
				<p>Cidade: ${dadosObjeto.endereco.nomeCidade}</p>
				<p>Estado: ${dadosObjeto.endereco.nomeEstado}</p>
			</div>
		`;

		$(".w > .b").empty();
		$(".w > .b").append("<div class='close'>X</div>");
		$(".w > .b").append(content);
		$(".w > .b").append("<div id='mapLugar'></div>");
		initMap();
		geocodeAddress(geocoder, map, `${dadosObjeto.endereco.logradouro}, ${dadosObjeto.endereco.numero} - ${dadosObjeto.endereco.bairro}, ${dadosObjeto.endereco.nomeCidade} - ${dadosObjeto.endereco.nomeEstado}`);
		$(".w").fadeIn();
	});
});




