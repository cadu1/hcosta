<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Sistema de Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container box-mensagem-crud'>
		<?php 
		require 'conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = isset($_POST['acao']) ? trim($_POST['acao']) : '';
		$id = isset($_POST['id']) ? trim($_POST['id']) : '';
		$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
		$rg = isset($_POST['rg']) ? trim($_POST['rg']) : '';
		$cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
		$genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
		$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
		$celular = isset($_POST['celular']) ? trim($_POST['celular']) : '';
		$email = isset($_POST['email']) ? trim($_POST['email']) : '';

		// Valida os dados recebidos
		$mensagem = '';
		if ($acao == 'editar' && $id == ''){
		    $mensagem .= '<li>Ops! Vocês está tentando alterar uma pessoas que talvez não exista</li>';
	    }

	    // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'){
			if ($nome == '' || strlen($nome) < 3){
				$mensagem .= '<li>Nome não pode ser vazio</li>';
		    }

			if ($cpf == ''){
				$mensagem .= '<li>CPF não pode ser vazio</li>';
		    } elseif(strlen($cpf) < 11){
				$mensagem .= '<li>Formato do CPF inválido</li>';
		    }

			if ($rg == ''){
			   $mensagem .= '<li>RG não pode ser vazio</li>';
		    }

			if ($email == ''){
				$mensagem .= '<li>E-mail não pode ser vazio</li>';
			} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$mensagem .= '<li>Formato do E-mail inválido</li>';
			}

			if ($telefone == '') {
				$mensagem .= '<li>Telefone não pode ser vazio</li>';
			} elseif(strlen($telefone) < 10) {
				$mensagem .= '<li>Formato do Telefone inválido</li>';
		    }

			if ($celular == '') {
				$mensagem .= '<li>Celular não pode ser vazio</li>';
			} elseif(strlen($celular) < 11) {
				$mensagem .= '<li>Formato do Celular inválido</li>';
			}

			if ($genero == '') {
			   $mensagem .= '<li>Gênero não pode ser vazio</li>';
			}

			if ($mensagem != '') {
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			}
		}

		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir') {
			$sql = 'INSERT INTO pessoas (nome_pes, rg_pes, cpf_pes, genero_pes, telefone_pes, celular_pes, email_pes, exibe_pes) VALUES(:nome, :rg, :cpf, :genero, :telefone, :celular, :email, true)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':rg', $rg);
			$stm->bindValue(':cpf', $cpf);
			$stm->bindValue(':genero', $genero);
			$stm->bindValue(':telefone', $telefone);
			$stm->bindValue(':celular', $celular);
			$stm->bindValue(':email', $email);
			$retorno = $stm->execute();

			if ($retorno){
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde!</div>";
			} else {
		    	echo "<div class='alert alert-danger' role='alert'>Ops! Ocorreu um erro ao inserir registro, tente novamente!</div>";
			}

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		}

		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'){
			$sql = 'UPDATE pessoas SET nome_pes=:nome, rg_pes=:rg, cpf_pes=:cpf, genero_pes=:genero, telefone_pes=:telefone, celular_pes=:celular, email_pes=:email WHERE id_pes = :id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':rg', $rg);
			$stm->bindValue(':cpf', $cpf);
			$stm->bindValue(':genero', $genero);
			$stm->bindValue(':telefone', $telefone);
			$stm->bindValue(':celular', $celular);
			$stm->bindValue(':email', $email);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno){
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde!</div> ";
			} else {
		    	echo "<div class='alert alert-danger' role='alert'>Ops! Parece que ocorreu um erro ao editar, tente novamente!</div> ";
			}

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		}

		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'){
			// Exclui o registro do banco de dados
			$sql = 'UPDATE pessoas SET exibe_pes = false WHERE id_pes = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno){
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde!</div> ";
			} else {
		    	echo "<div class='alert alert-danger' role='alert'>Ops! Parece que ocorreu um erro ao excluir registro, tente novamente!</div> ";
			}

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		}
		?>
	</div>
</body>
</html>