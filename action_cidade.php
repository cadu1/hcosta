<?php 
require 'conexao.php';

// Atribui uma conexão PDO
$conexao = conexao::getInstance();

// Recebe os dados enviados pela submissão
$uf = isset($_GET['uf']) ? trim($_GET['uf']) : '';

// Valida os dados recebidos
if ($uf == ''){
	exit;
}

// Verifica se foi solicitada a inclusão de dados
$sql = 'SELECT id_cid, nome_cid FROM cidades WHERE uf_cid = :uf';
$stm = $conexao->prepare($sql);
$stm->bindValue(':uf', $uf);
$stm->execute();

$cidades = $stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cidades, JSON_NUMERIC_CHECK);