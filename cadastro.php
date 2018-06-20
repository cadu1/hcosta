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
			<form action="action_cliente.php" method="post" id='form-contato'>
			    <div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
					<span class='msg-erro msg-nome'></span>
			    </div>
			    <div class="form-group">
					<label for="rg">RG</label>
					<input type="text" class="form-control" id="rg" maxlength="15" name="rg" placeholder="Informe o RG">
					<span class='msg-erro msg-rg'></span>
			    </div>
			    <div class="form-group">
					<label for="cpf">CPF</label>
					<input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" placeholder="Informe o CPF">
					<span class='msg-erro msg-cpf'></span>
			    </div>
			    <div class="form-group">
					<label for="genero">Gênero</label>
					<select class="form-control" name="genero" id="genero">
						<option value="">Selecione</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
					</select>
					<span class='msg-erro msg-genero'></span>
			    </div>
			    <div class="form-group">
					<label for="telefone">Telefone</label>
					<input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" placeholder="Informe o Telefone">
					<span class='msg-erro msg-telefone'></span>
			    </div>
			    <div class="form-group">
					<label for="celular">Celular</label>
					<input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
					<span class='msg-erro msg-celular'></span>
			    </div>
			    <div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Informe o E-mail">
					<span class='msg-erro msg-email'></span>
			    </div>

				<h4>Endereço</h4>
			    <div class="form-group">
					<label for="rua">Rua</label>
					<input type="text" class="form-control" id="rua" name="rua" placeholder="Informe nome da Rua" max-length="100">
					<span class='msg-erro msg-rua'></span>
			    </div>
			    <div class="form-group">
					<label for="numero">Número</label>
					<input type="text" class="form-control" id="numero" name="numero" placeholder="Informe o número" max-length="10">
					<span class='msg-erro msg-numero'></span>
			    </div>
			    <div class="form-group">
					<label for="complemento">Complemento</label>
					<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Informe o Complemento" max-length="50">
					<span class='msg-erro msg-complemento'></span>
			    </div>
			    <div class="form-group">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe o bairro" max-length="60">
					<span class='msg-erro msg-bairro'></span>
			    </div>
			    <div class="form-group">
					<label for="cidade">Cidade</label>
					<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Informe o cidade" max-length="60">
					<span class='msg-erro msg-cidade'></span>
			    </div>
			    <div class="form-group">
					<label for="uf">UF</label>
					<select class="form-control" name="uf" id="uf">
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

				<div class="form-group">
					<label for="cep">CEP</label>
					<input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP" max-length="8">
					<span class='msg-erro msg-cep'></span>
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