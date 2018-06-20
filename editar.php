<?php
require 'conexao.php';

// Recebe o id via GET
$id = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id) && filter_var($id, FILTER_SANITIZE_NUMBER_INT)) {
	// Captura os dados
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_pes, nome_pes, rg_pes, cpf_pes, genero_pes, telefone_pes, celular_pes, email_pes FROM pessoas WHERE id_pes = :id AND exibe_pes = true';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id);
	$stm->execute();
	$cliente = $stm->fetch(PDO::FETCH_OBJ);
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
			if(empty($cliente)) {
				?>
				<h3 class="text-center text-danger">Pessoa não encontrada!</h3>
				<?php 
			} else {
				?>
				<form action="action_cliente.php" method="post" id='form-contato'>
				    <div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente->nome_pes; ?>" placeholder="Informe o Nome">
						<span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
						<label for="rg">RG</label>
						<input type="rg" class="form-control" id="rg" maxlength="14" name="rg" value="<?php echo $cliente->rg_pes; ?>" placeholder="Informe o RG">
						<span class='msg-erro msg-rg'></span>
				    </div>

				    <div class="form-group">
						<label for="cpf">CPF</label>
						<input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?php echo $cliente->cpf_pes; ?>" placeholder="Informe o CPF">
						<span class='msg-erro msg-cpf'></span>
				    </div>

				    <div class="form-group">
				      <label for="genero">Gênero</label>
				      <select class="form-control" name="genero" id="genero">
							<option value=""></option>
							<option value="M" <?php echo $cliente->genero_pes == 'M' ? 'selected' : ''; ?>>Masculino</option>
							<option value="F" <?php echo $cliente->genero_pes == 'F' ? 'selected' : ''; ?>>Feminino</option>
					  </select>
					  <span class='msg-erro msg-genero'></span>
				    </div>

				    <div class="form-group">
						<label for="telefone">Telefone</label>
						<input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?php echo $cliente->telefone_pes; ?>" placeholder="Informe o Telefone">
						<span class='msg-erro msg-telefone'></span>
				    </div>

				    <div class="form-group">
						<label for="celular">Celular</label>
						<input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?php echo $cliente->celular_pes; ?>" placeholder="Informe o Celular">
						<span class='msg-erro msg-celular'></span>
				    </div>

				    <div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $cliente->email_pes; ?>" placeholder="Informe o E-mail">
						<span class='msg-erro msg-email'></span>
				    </div>

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?php echo $cliente->id_pes; ?>">
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