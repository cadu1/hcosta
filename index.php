<?php
require 'conexao.php';

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)){
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_pes, nome_pes, email_pes, celular_pes FROM pessoas WHERE exibe_pes = true';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
} else {
	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_pes, nome_pes, email_pes, celular_pes FROM pessoas WHERE exibe_pes = true AND (UPPER(nome_pes) LIKE :nome OR UPPER(email_pes) LIKE :email)';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':nome', strtoupper($termo).'%');
	$stm->bindValue(':email', strtoupper($termo).'%');
	$stm->execute();
	$pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Listagem de Pessoas</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<!-- Cabeçalho da Listagem -->
			<legend><h3>Listagem de Pessoas</h3></legend>

			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Nome ou E-mail">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
			    <a href='index.php' class="btn btn-primary">Ver Todos</a>
			</form>

			<!-- Link para página de cadastro -->
			<a href='cadastro.php' class="btn btn-success pull-right">Cadastrar Pessoas</a>
			<div class='clearfix'></div>
			<?php 
			if(!empty($pessoas)) {
				?>
				<table class="table table-striped">
					<tr class='active'>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Celular</th>
						<th>Ação</th>
					</tr>
					<?php 
					foreach($pessoas as $pessoa) {
						?>
						<tr>
							<td><?php echo $pessoa->nome_pes; ?></td>
							<td><?php echo $pessoa->email_pes; ?></td>
							<td><?php echo $pessoa->celular_pes; ?></td>
							<td>
								<a href='editar.php?id=<?php echo $pessoa->id_pes; ?>' class="btn btn-primary">Editar</a>
								<a href='javascript:;' class="btn btn-danger link_exclusao" rel="<?php echo $pessoa->id_pes; ?>">Excluir</a>
							</td>
						</tr>	
						<?php 
						}
					?>
				</table>
				<?php
			} else {
				?>
				<!-- Mensagem caso não exista pessoas ou não encontre  -->
				<h3 class="text-center text-primary">Não existem pessoas cadastradas!</h3>
				<?php 
			}
			?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>