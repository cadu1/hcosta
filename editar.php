<?php
require 'conexao.php';

// Recebe o id via GET
$id = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id) && filter_var($id, FILTER_SANITIZE_NUMBER_INT)) {
	// Captura os dados
	$conexao = conexao::getInstance();
	$sql = 'SELECT p.*, rua_end, numero_end, compl_end, bairro_end, cep_end, nome_cid, uf_cid, e.id_cid FROM pessoas p JOIN enderecos e ON e.id_pes = p.id_pes JOIN cidades c ON c.id_cid = e.id_cid WHERE p.id_pes = :id AND exibe_pes = true';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id);
	$stm->execute();
	$pessoa = $stm->fetch(PDO::FETCH_OBJ);

	$sql = 'SELECT * FROM cidades WHERE uf_cid = :uf';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':uf', $pessoa->uf_cid);
	$stm->execute();
	$arrUF = $stm->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Registro</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Edição de Registro</h1></legend>
			<?php 
			if(empty($pessoa)) {
				?>
				<h3 class="text-center text-danger">Pessoa não encontrada!</h3>
				<?php 
			} else {
				?>
				<form action="action_pessoa.php" method="post" id='form-contato'>
				    <div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $pessoa->nome_pes; ?>" placeholder="Informe o Nome">
						<span class='msg-erro msg-nome'></span>
				    </div>

					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="rg">RG</label>
							<input type="rg" class="form-control" id="rg" maxlength="14" name="rg" value="<?php echo $pessoa->rg_pes; ?>" placeholder="Informe o RG">
							<span class='msg-erro msg-rg'></span>
					    </div>
						<div class="col-sm-6 col-md-6">
							<label for="cpf">CPF</label>
							<input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?php echo $pessoa->cpf_pes; ?>" placeholder="Informe o CPF">
							<span class='msg-erro msg-cpf'></span>
					    </div>
					</div>

					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="genero">Gênero</label>
							<select class="form-control" name="genero" id="genero">
									<option value=""></option>
									<option value="M" <?php echo $pessoa->genero_pes == 'M' ? 'selected' : ''; ?>>Masculino</option>
									<option value="F" <?php echo $pessoa->genero_pes == 'F' ? 'selected' : ''; ?>>Feminino</option>
							</select>
							<span class='msg-erro msg-genero'></span>
					    </div>
						<div class="col-sm-6 col-md-6">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $pessoa->email_pes; ?>" placeholder="Informe o E-mail">
							<span class='msg-erro msg-email'></span>
					    </div>
				    </div>

					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="telefone">Telefone</label>
							<input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?php echo $pessoa->telefone_pes; ?>" placeholder="Informe o Telefone">
							<span class='msg-erro msg-telefone'></span>
					    </div>
						<div class="col-sm-6 col-md-6">
							<label for="celular">Celular</label>
							<input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?php echo $pessoa->celular_pes; ?>" placeholder="Informe o Celular">
							<span class='msg-erro msg-celular'></span>
					    </div>
				    </div>

					<h4>Endereço</h4>
					<div class="form-group">
						<label for="rua">Rua</label>
						<input type="text" class="form-control" id="rua" value="<?php echo $pessoa->rua_end; ?>" name="rua" placeholder="Informe nome da Rua" maxlength="100">
						<span class='msg-erro msg-rua'></span>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="numero">Número</label>
							<input type="text" class="form-control" id="numero" name="numero" value="<?php echo $pessoa->numero_end; ?>" placeholder="Informe o número" maxlength="10">
							<span class='msg-erro msg-numero'></span>
						</div>
						<div class="col-sm-6 col-md-6">
							<label for="complemento">Complemento</label>
							<input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $pessoa->compl_end; ?>" placeholder="Informe o Complemento" maxlength="50">
							<span class='msg-erro msg-complemento'></span>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="bairro">Bairro</label>
							<input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $pessoa->bairro_end; ?>" placeholder="Informe o bairro" maxlength="60">
							<span class='msg-erro msg-bairro'></span>
						</div>
						<div class="col-sm-6 col-md-6">
							<label for="cep">CEP</label>
							<input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP" value="<?php echo $pessoa->cep_end; ?>" maxlength="9">
							<span class='msg-erro msg-cep'></span>
						</div>
					</div>
					<?php
					$strUF = $pessoa->uf_cid;
					?>
					<div class="row form-group">
						<div class="col-sm-6 col-md-6">
							<label for="uf">UF</label>
							<select class="form-control" id="uf" onchange="busca_cidade(this)">
								<option value=""></option>
								<option value="AC" <?php echo $strUF == 'AC' ? 'selected' : ''; ?>>Acre</option>
								<option value="AL" <?php echo $strUF == 'AL' ? 'selected' : ''; ?>>Alagoas</option>
								<option value="AP" <?php echo $strUF == 'AP' ? 'selected' : ''; ?>>Amapá</option>
								<option value="AM" <?php echo $strUF == 'AM' ? 'selected' : ''; ?>>Amazonas</option>
								<option value="BA" <?php echo $strUF == 'BA' ? 'selected' : ''; ?>>Bahia</option>
								<option value="CE" <?php echo $strUF == 'CE' ? 'selected' : ''; ?>>Ceará</option>
								<option value="DF" <?php echo $strUF == 'DF' ? 'selected' : ''; ?>>Distrito Federal</option>
								<option value="ES" <?php echo $strUF == 'ES' ? 'selected' : ''; ?>>Espírito Santo</option>
								<option value="GO" <?php echo $strUF == 'GO' ? 'selected' : ''; ?>>Goiás</option>
								<option value="MA" <?php echo $strUF == 'MA' ? 'selected' : ''; ?>>Maranhão</option>
								<option value="MT" <?php echo $strUF == 'MT' ? 'selected' : ''; ?>>Mato Grosso</option>
								<option value="MS" <?php echo $strUF == 'MS' ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
								<option value="MG" <?php echo $strUF == 'MG' ? 'selected' : ''; ?>>Minas Gerais</option>
								<option value="PA" <?php echo $strUF == 'PA' ? 'selected' : ''; ?>>Pará</option>
								<option value="PB" <?php echo $strUF == 'PB' ? 'selected' : ''; ?>>Paraíba</option>
								<option value="PR" <?php echo $strUF == 'PR' ? 'selected' : ''; ?>>Paraná</option>
								<option value="PE" <?php echo $strUF == 'PE' ? 'selected' : ''; ?>>Pernambuco</option>
								<option value="PI" <?php echo $strUF == 'PI' ? 'selected' : ''; ?>>Piauí</option>
								<option value="RJ" <?php echo $strUF == 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
								<option value="RN" <?php echo $strUF == 'RN' ? 'selected' : ''; ?>>Rio Grande do Norte</option>
								<option value="RS" <?php echo $strUF == 'RS' ? 'selected' : ''; ?>>Rio Grande do Sul</option>
								<option value="RO" <?php echo $strUF == 'RO' ? 'selected' : ''; ?>>Rondônia</option>
								<option value="RR" <?php echo $strUF == 'RR' ? 'selected' : ''; ?>>Roraima</option>
								<option value="SC" <?php echo $strUF == 'SC' ? 'selected' : ''; ?>>Santa Catarina</option>
								<option value="SP" <?php echo $strUF == 'SP' ? 'selected' : ''; ?>>São Paulo</option>
								<option value="SE" <?php echo $strUF == 'SE' ? 'selected' : ''; ?>>Sergipe</option>
								<option value="TO" <?php echo $strUF == 'TO' ? 'selected' : ''; ?>>Tocantins</option>
							</select>
						</div>
						<div class="col-sm-6 col-md-6">
							<label for="cidade">Cidade</label>
							<select class="form-control cidade" name="cidade" id="cidade">
								<?php
								foreach($arrUF as $uf) {
									$select = $pessoa->id_cid == $uf['id_cid'] ? 'selected' : '';
									echo "<option value='{$uf['id_cid']}' $select>{$uf['nome_cid']}</option>";
								}
								?>
							</select>
							<span class='msg-erro msg-cidade'></span>
						</div>
					</div>

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?php echo $pessoa->id_pes; ?>">
				    <button type="submit" class="btn btn-primary" id='botao'>Gravar</button>
				    <a href='index.php' class="btn btn-danger">Cancelar</a>
				</form>
				<?php 
			}
			?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>