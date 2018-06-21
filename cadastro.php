<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de Pessoa</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h3>Novo Registro</h3></legend>
			<form action="action_pessoa.php" method="post" id='form-contato'>
			    <div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" maxlength="150" placeholder="Informe o Nome">
					<span class='msg-erro msg-nome'></span>
			    </div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="rg">RG</label>
						<input type="text" class="form-control" id="rg" maxlength="15" name="rg" placeholder="Informe o RG">
						<span class='msg-erro msg-rg'></span>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="cpf">CPF</label>
						<input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" placeholder="Informe o CPF">
						<span class='msg-erro msg-cpf'></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="genero">Gênero</label>
						<select class="form-control" name="genero" id="genero">
							<option value="">Selecione</option>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
						</select>
						<span class='msg-erro msg-genero'></span>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="email">E-mail</label>
						<input type="email" class="form-control" id="email" maxlength="150" name="email" placeholder="Informe o E-mail">
						<span class='msg-erro msg-email'></span>
					</div>
			    </div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="telefone">Telefone</label>
						<input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" placeholder="Informe o Telefone">
						<span class='msg-erro msg-telefone'></span>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="celular">Celular</label>
						<input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
						<span class='msg-erro msg-celular'></span>
					</div>
			    </div>

				<h4>Endereço</h4>
				<div class="form-group">
					<label for="rua">Rua</label>
					<input type="text" class="form-control" id="rua" name="rua" placeholder="Informe nome da Rua" maxlength="100">
					<span class='msg-erro msg-rua'></span>
				</div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="numero">Número</label>
						<input type="text" class="form-control" id="numero" name="numero" placeholder="Informe o número" maxlength="10">
						<span class='msg-erro msg-numero'></span>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="complemento">Complemento</label>
						<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Informe o Complemento" maxlength="50">
						<span class='msg-erro msg-complemento'></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="bairro">Bairro</label>
						<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe o bairro" maxlength="60">
						<span class='msg-erro msg-bairro'></span>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="cep">CEP</label>
						<input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP" maxlength="9">
						<span class='msg-erro msg-cep'></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-6 col-md-6">
						<label for="uf">UF</label>
						<select class="form-control" id="uf" onchange="busca_cidade(this)">
							<option value=""></option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
					</div>
					<div class="col-sm-6 col-md-6">
						<label for="cidade">Cidade</label>
						<select class="form-control cidade" name="cidade" id="cidade"></select>
						<span class='msg-erro msg-cidade'></span>
					</div>
				</div>

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'>Gravar</button>
			    <a href='index.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
	
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>