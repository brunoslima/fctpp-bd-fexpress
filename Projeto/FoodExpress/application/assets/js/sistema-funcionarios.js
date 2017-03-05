$(document).ready(function(){

	var lista = {};
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
	 		$dados['chaveMotorista'] = $("input[name='chaveMotorista']").val();
	 		$dados['senhaMotorista'] = $("input[name='senhaMotorista']").val();
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

	 $(document).on("change",'[name="alterarFuncionario"]', function(){
		let valor = $(this).val();
		
		let conjunto = valor.split(' ');
		lista.cargo = conjunto[1];
		lista.id = parseInt(conjunto[0]);

		$('.block').remove();
		if (lista.id != 0){
			$(this).attr("disabled", true);
			recuperarDados(lista, "/recuperarFuncionario");

			$('.editarfuncionario [name="nome"]').val(dadosObjeto.func.nome);
			$('.editarfuncionario [name="dataNascimento"]').val(dadosObjeto.func.dataContratacao);
			$('.editarfuncionario [name="dataContratacao"]').val(dadosObjeto.func.dataNascimento);
			$('.editarfuncionario [name="salario"]').val(parseFloat(dadosObjeto.func.salario).toFixed(2));
			

			let content = '';
			if(lista.cargo == "Segurança"){
				content += `<label>Possui porte de arma? </label><br>
					<select name="porte" >
						<optgroup>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</optgroup>
					</select>`;

				content = `<br><br><div class="block">${content}</div>`;


				$('[name="salario"]').after(content);
				$('.editarfuncionario [name="porte"]').val(dadosObjeto.outro.porteArma);	
			}
			else if (lista.cargo == "Gerência"){
				content += `<label>Informações de Contato e Acesso</label><br><input type="email" name="contato" placeholder="E-mail de Contato" />
					<input type="email" name="login" placeholder="E-mail de Login" /><br>
					<input type="password" name="senha" placeholder="Senha Antiga" />
					<input type="password" name="confirmsenha" placeholder="Senha Nova" />`;
				content = `<br><br><div class="block">${content}</div>`;


				$('[name="salario"]').after(content);
				$('.editarfuncionario [name="contato"]').val(dadosObjeto.outro.email);	
				$('.editarfuncionario [name="login"]').val(dadosObjeto.outro.login);	

			}
			else if (lista.cargo == "Motorista") {
				content += `<label>Categoria de Habilitação</label><br><select name="categoria">
						<optgroup>
							<option value="0">A</option>
							<option value="1">B</option>
							<option value="2">C</option>
							<option value="3">D</option>
							<option value="4">E</option>
						</optgroup>
					</select>
					<br><br />
					<label>Informações de Contato</label><br>
					<br /><label>Código</label><br />
					<input type="text" name="codigo" placeholder="Código"/><br />
					<label>Área</label><br />
					<input type="text" name="area" placeholder="Área"/><br />
					<label>Número</label><br />
					<input type="text" name="numero" placeholder="Número"/><br><br>
					<label>Chave de Acesso e senha para o sistema</label><br>
					<input type="text" name="chaveMotorista" placeholder="Chave de acesso"/>
					<input type="text" name="senhaMotorista" placeholder="Senha Antiga"/>
					<input type="text" name="senhaMotoristaNova" placeholder="Senha Nova"/>`;

					content = `<br><br><div class="block">${content}</div>`;

					$('[name="salario"]').after(content);
					$('.editarfuncionario [name="categoria"]').val(dadosObjeto.outro.categoriaHabilitacao);
					$('.editarfuncionario [name="codigo"]').val(dadosObjeto.outro.codigo);
					$('.editarfuncionario [name="area"]').val(dadosObjeto.outro.area);
					$('.editarfuncionario [name="numero"]').val(dadosObjeto.outro.numero);
					$('.editarfuncionario [name="chaveMotorista"]').val(dadosObjeto.outro.chaveAcesso);

			}
			else{

				content += `<label>Setor</label><br /><input type="text" name="setor" placeholder="Setor" />`;
				content = `<br><br><div class="block">${content}</div>`;


				$('[name="salario"]').after(content);
				$('.editarfuncionario [name="setor"]').val(dadosObjeto.outro.setor);
			}
		}
	});

	$(document).on("click", ".btn-alterar-funcionario", function(e){
		e.preventDefault();

		let dados = {};
		dados['id'] = lista.id;
		dados['nome'] = $('.editarfuncionario [name="nome"]').val();
		dados['nasc'] = $('.editarfuncionario [name="dataNascimento"]').val();
		dados['cont'] = $('.editarfuncionario [name="dataContratacao"]').val();
		dados['salario'] = $('.editarfuncionario [name="salario"]').val();
			

		if(lista.cargo == "Segurança"){

			dados['porte'] = $('.editarfuncionario [name="porte"]').val();
		}
		else if (lista.cargo == "Gerência"){

			dados['contato'] = $('.editarfuncionario [name="contato"]').val();
			dados['login'] = $('.editarfuncionario [name="login"]').val();
			dados['senhaAntiga'] = $('.editarfuncionario [name="senha"]').val();
			dados['senhaNova'] = $('.editarfuncionario [name="senhanova"]').val();

		}
		else if (lista.cargo == "Motorista") {
		

			dados['categoria'] = $('.editarfuncionario [name="categoria"]').val();
			dados['codigo'] = $('.editarfuncionario [name="codigo"]').val();
			dados['area'] = $('.editarfuncionario [name="area"]').val();
			dados['numero'] = $('.editarfuncionario [name="numero"]').val();
			dados['chave'] = $('.editarfuncionario [name="chaveMotorista"]').val();
			dados['senhaAntiga'] = $('.editarfuncionario [name="senhaMotorista"]').val();
			dados['senhaNova'] = $('.editarfuncionario [name="senhaMotoristaNova"]').val();

		}
		else{
			dados['setor'] = $('.editarfuncionario [name="setor"]').val();
		}

		console.log(dados);

		resetForm(".editarfuncionario");
	});

});