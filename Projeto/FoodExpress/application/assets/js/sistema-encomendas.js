class LinhaTabelaEncomenda{
	

	constructor(codigo, produto, quantidade, valor){
		this.codigo = codigo;
		this.produto = produto;
		this.quantidade = quantidade;
		this.valor = valor;
	}
}

var itensEncomenda = [];

$(document).ready(function(){

	
	let count = 0;
	let total = 0;
	let ValorProduto = 0;

	$(document).on("blur", "[name='boxProdutoEncomenda']", function(){

		$dados = new Object();

		$dados['nome'] = $(this).val();
		var endereco = location.href;
		endereco = endereco.split("/");
		var final = "http://" + endereco[2] + "/FoodExpress/gui/RetornaValorProduto";
		$.ajax({
			url: ( final),
			type: "post",
			async: true,
			data: $dados,
			cache: false
		})
		.done(function(data){
			ValorProduto = data;

		})
		.fail(function(){
			console.log("pãã");
		});
	});

	$(document).on("click",".btn-adicionar-itemEncomenda", function(event){

		event.preventDefault();
		var d = [];
		
		d["codigo"] = ++count;
		d["produto"] = $("[name='boxProdutoEncomenda']").val();
		d["quantidade"] =  parseFloat($("[name='quantidadeF']").val());
		d["valor"] = parseFloat(ValorProduto);

		//validar
		var validado = true;

		if(validado){
			
			let linha = "<tr><td>"+d['codigo']+"</td><td>"+d['produto']+"</td><td>"+d['quantidade'].toFixed(3)+"</td><td>R$ "+d['valor'].toFixed(2)+"</td><td>R$ "+(d['quantidade']*d['valor']).toFixed(2)+"</td></tr>";
			itensEncomenda.push(new LinhaTabelaEncomenda(d['codigo'],d['produto'],d['quantidade'],d['valor']));
			$(".item-pedido").append(linha);

			total = 0;
			for (let i = 0; i < itensEncomenda.length; i++) {

				total += itensEncomenda[i].quantidade*itensEncomenda[i].valor;
			}

			$('.total-compra')[0].innerText = "Total da Compra: R$ " + (parseFloat(total).toFixed(2)); 

			$(".message-alert").css("display","none");
		}
	}); 

	$(document).on("click", ".btn-finalizar-encomenda", function(event){

		event.preventDefault();

	 	let dados = {
	 		descricao: $("[name='descricaoPagamento']").val(),
	 		total: total,
	 		itens: itensEncomenda
	 	}

	 	$.ajax({
			url: ( location.href + "/finalizarEncomenda"),
			type: "post",
			async: true,
			data: dados,
			cache: false
		})
		.done(function(data){
			//data = $.parseJSON(data);
			console.log(data);
			console.log("Encomenda cadastrada com sucesso!");
		})
		.fail(function(){
			console.log("pãã pãã pãã pãã hey");
		});
	});
});