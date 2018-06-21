/* Atribui ao evento submit do formulário a função de validação de dados */
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
	form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {
	form.attachEvent("onsubmit", validaCadastro);
}

/* Atribui ao evento keypress do input cpf a função para formatar o CPF */
var inputCPF = document.getElementById("cpf");
if (inputCPF != null && inputCPF.addEventListener) {
	inputCPF.addEventListener("keypress", function () { mascaraTexto(this, '###.###.###-##') });
} else if (inputCPF != null && inputCPF.attachEvent) {
	inputCPF.attachEvent("onkeypress", function () { mascaraTexto(this, '###.###.###-##') });
}

/* Atribui ao evento keypress do input telefone a função para formatar o Telefone (00 0000-0000) */
var inputTelefone = document.getElementById("telefone");
if (inputTelefone != null && inputTelefone.addEventListener) {
	inputTelefone.addEventListener("keypress", function () { mascaraTexto(this, '## ####-####') });
} else if (inputTelefone != null && inputTelefone.attachEvent) {
	inputTelefone.attachEvent("onkeypress", function () { mascaraTexto(this, '## ####-####') });
}

/* Atribui ao evento keypress do input celular a função para formatar o Celular (00 00000-0000) */
var inputCelular = document.getElementById("celular");
if (inputCelular != null && inputCelular.addEventListener) {
	inputCelular.addEventListener("keypress", function () { mascaraTexto(this, '## #####-####') });
} else if (inputCelular != null && inputCelular.attachEvent) {
	inputCelular.attachEvent("onkeypress", function () { mascaraTexto(this, '## #####-####') });
}

/* Atribui ao evento keypress do input celular a função para formatar o Celular (00 00000-0000) */
var inputCep = document.getElementById("cep");
if (inputCep != null && inputCep.addEventListener) {
	inputCep.addEventListener("keypress", function () { mascaraTexto(this, '#####-###') });
} else if (inputCep != null && inputCep.attachEvent) {
	inputCep.attachEvent("onkeypress", function () { mascaraTexto(this, '#####-###') });
}

/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null) {
	for (var i = 0; i < linkExclusao.length; i++) {
		(function (i) {
			var id_pessoa = linkExclusao[i].getAttribute('rel');

			if (linkExclusao[i].addEventListener) {
				linkExclusao[i].addEventListener("click", function () { confirmaExclusao(id_pessoa); });
			} else if (linkExclusao[i].attachEvent) {
				linkExclusao[i].attachEvent("onclick", function () { confirmaExclusao(id_pessoa); });
			}
		})(i);
	}
}

/* Função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
	nome = document.getElementById('nome');
	rg = document.getElementById('rg');
	cpf = document.getElementById('cpf');
	genero = document.getElementById('genero');
	telefone = document.getElementById('telefone');
	celular = document.getElementById('celular');
	filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	email = document.getElementById('email');
	rua = document.getElementById('rua');
	contErro = 0;

	/* Validação do campo nome */
	caixa_nome = document.querySelector('.msg-nome');
	if (nome.value == "") {
		caixa_nome.innerHTML = "Nome não pode estar vazio";
		caixa_nome.style.display = 'block';
		contErro += 1;
	} else {
		caixa_nome.style.display = 'none';
	}

	/* Validação do campo email */
	caixa_email = document.querySelector('.msg-email');
	if (email.value == "") {
		caixa_email.innerHTML = "E-mail não pode estar vazio";
		caixa_email.style.display = 'block';
		contErro += 1;
	} else if (filtro.test(email.value)) {
		caixa_email.style.display = 'none';
	} else {
		caixa_email.innerHTML = "Formato do E-mail inválido";
		caixa_email.style.display = 'block';
		contErro += 1;
	}

	/* Validação do campo cpf */
	caixa_cpf = document.querySelector('.msg-cpf');
	if (cpf.value == "") {
		caixa_cpf.innerHTML = "CPF não pode estar vazio";
		caixa_cpf.style.display = 'block';
		contErro += 1;
	} else {
		caixa_cpf.style.display = 'none';
	}

	if (!TestaCPF(cpf.value.replace(/\./g, '').replace('-', ''))) {
		caixa_cpf.innerHTML = "O CPF informado não é valido";
		caixa_cpf.style.display = 'block';
		contErro += 1;
	} else {
		caixa_cpf.style.display = 'none';
	}

	/* Validação do campo rg */
	caixa_rg = document.querySelector('.msg-rg');
	if (rg.value == "") {
		caixa_rg.innerHTML = "RG não pode estar vazio";
		caixa_rg.style.display = 'block';
		contErro += 1;
	} else {
		caixa_rg.style.display = 'none';
	}

	/* Validação do campo telefone */
	caixa_telefone = document.querySelector('.msg-telefone');
	if (telefone.value == "") {
		caixa_telefone.innerHTML = "Telefone não pode estar vazio";
		caixa_telefone.style.display = 'block';
		contErro += 1;
	} else {
		caixa_telefone.style.display = 'none';
	}

	/* Validação do campo celular */
	caixa_celular = document.querySelector('.msg-celular');
	if (celular.value == "") {
		caixa_celular.innerHTML = "Celular não pode estar vazio";
		caixa_celular.style.display = 'block';
		contErro += 1;
	} else {
		caixa_celular.style.display = 'none';
	}

	/* Validação do campo genero */
	caixa_genero = document.querySelector('.msg-genero');
	if (genero.value == "") {
		caixa_genero.innerHTML = "Selecione uma opção";
		caixa_genero.style.display = 'block';
		contErro += 1;
	} else {
		caixa_genero.style.display = 'none';
	}

	/* Validação de rua */
	caixa_rua = document.querySelector('.msg-rua');
	if (rua.value == "") {
		caixa_rua.innerHTML = "Rua não pode estar vazio";
		caixa_rua.style.display = 'block';
		contErro += 1;
	} else {
		caixa_rua.style.display = 'none';
	}
	/* Validação de bairro */
	caixa_bairro = document.querySelector('.msg-bairro');
	if (bairro.value == "") {
		caixa_bairro.innerHTML = "Bairro não pode estar vazio";
		caixa_bairro.style.display = 'block';
		contErro += 1;
	} else {
		caixa_bairro.style.display = 'none';
	}
	/* Validação de cep */
	caixa_cep = document.querySelector('.msg-cep');
	if (cep.value == "") {
		caixa_cep.innerHTML = "CEP não pode estar vazio";
		caixa_cep.style.display = 'block';
		contErro += 1;
	} else {
		caixa_cep.style.display = 'none';
	}
	/* Validação de cidade */
	caixa_cidade = document.querySelector('.msg-cidade');
	if (cidade.value == "") {
		caixa_cidade.innerHTML = "Selecione uma Cidade";
		caixa_cidade.style.display = 'block';
		contErro += 1;
	} else {
		caixa_cidade.style.display = 'none';
	}

	if (contErro > 0) {
		evt.preventDefault();
		return false;
	}
}

function TestaCPF(strCPF) {
	Soma = 0;
	if (strCPF == "00000000000") {
		return false;
	}

	for (i = 1; i <= 9; i++) {
		Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
	}
	Resto = (Soma * 10) % 11;

	if ((Resto == 10) || (Resto == 11)) {
		Resto = 0;
	}
	if (Resto != parseInt(strCPF.substring(9, 10))) {
		return false;
	}

	Soma = 0;
	for (i = 1; i <= 10; i++) {
		Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
	}
	Resto = (Soma * 10) % 11;

	if ((Resto == 10) || (Resto == 11)) {
		Resto = 0;
	}
	if (Resto != parseInt(strCPF.substring(10, 11))) {
		return false;
	}
	return true;
}

/* Função para formatar dados conforme parâmetro enviado, CPF, DATA, TELEFONE e CELULAR */
function mascaraTexto(t, mask) {
	var i = t.value.length;
	var saida = mask.substring(1, 0);
	var texto = mask.substring(i);

	if (texto.substring(0, 1) != saida) {
		t.value += texto.substring(0, 1);
	}
}

/* Função para exibir um alert confirmando a exclusão do registro*/
function confirmaExclusao(id) {
	retorno = confirm("Deseja excluir esse Registro?")

	if (retorno) {

		//Cria um formulário
		var formulario = document.createElement("form");
		formulario.action = "action_pessoa.php";
		formulario.method = "post";

		// Cria os inputs e adiciona ao formulário
		var inputAcao = document.createElement("input");
		inputAcao.type = "hidden";
		inputAcao.value = "excluir";
		inputAcao.name = "acao";
		formulario.appendChild(inputAcao);

		var inputId = document.createElement("input");
		inputId.type = "hidden";
		inputId.value = id;
		inputId.name = "id";
		formulario.appendChild(inputId);

		//Adiciona o formulário ao corpo do documento
		document.body.appendChild(formulario);

		//Envia o formulário
		formulario.submit();
	}
}

function busca_cidade(obj) {
	div = obj.parentElement.parentElement;
	uf = obj.value;
	if (uf != '') {
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (xhttp.readyState == XMLHttpRequest.DONE) {
				dropdown = div.getElementsByClassName('cidade')[0];
				dropdown.innerHTML = '';
				data = JSON.parse(xhttp.responseText);
				for (i = 0; i < data.length; i++) {
					option = document.createElement('option');
					option.text = data[i].nome_cid;
					option.value = data[i].id_cid;
					dropdown.add(option);
				}
			}
		}
		xhttp.open("GET", "action_cidade?uf=" + uf, true);
		xhttp.send();
	}
}