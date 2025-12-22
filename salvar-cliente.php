<?php
	session_start();
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	
	if (!$conexao) {
		$_SESSION['mensagem'] = "Erro na conexão com o banco de dados: " . mysqli_connect_error();
		$_SESSION['tipo_mensagem'] = "danger";
		header("Location: ?page=listar-cliente");
		exit;
	}
	
	$id_cliente = $_POST['id_cliente'] ?? 0;
	$nome_cliente = mysqli_real_escape_string($conexao, $_POST['nome_cliente'] ?? '');
	$cpf_cliente = mysqli_real_escape_string($conexao, $_POST['cpf_cliente'] ?? '');
	$email_cliente = mysqli_real_escape_string($conexao, $_POST['email_cliente'] ?? '');
	$telefone_cliente = mysqli_real_escape_string($conexao, $_POST['telefone_cliente'] ?? '');
	$endereco_cliente = mysqli_real_escape_string($conexao, $_POST['endereco_cliente'] ?? '');
	$dt_nasc_cliente = mysqli_real_escape_string($conexao, $_POST['dt_nasc_cliente'] ?? '');

	if ($id_cliente > 0) {
	$sql = "UPDATE cliente SET 
				nome_cliente = '$nome_cliente',
				cpf_cliente = '$cpf_cliente',
				email_cliente = '$email_cliente',
				telefone_cliente = '$telefone_cliente',
				endereco_cliente = '$endereco_cliente',
				dt_nasc_cliente = '$dt_nasc_cliente'
				WHERE id_cliente = $id_cliente";
		
		if (mysqli_query($conexao, $sql)) {
			$_SESSION['mensagem'] = "Cliente atualizado com sucesso!";
			$_SESSION['tipo_mensagem'] = "success";
		} else {
			$_SESSION['mensagem'] = "Erro ao atualizar cliente: " . mysqli_error($conexao);
			$_SESSION['tipo_mensagem'] = "danger";
		}
	} else {
		$sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, endereco_cliente, dt_nasc_cliente) 
				VALUES ('$nome_cliente', '$cpf_cliente', '$email_cliente', '$telefone_cliente', '$endereco_cliente', '$dt_nasc_cliente')";
		
		if (mysqli_query($conexao, $sql)) {
			$_SESSION['mensagem'] = "Cliente cadastrado com sucesso!";
			$_SESSION['tipo_mensagem'] = "success";
		} else {
			$_SESSION['mensagem'] = "Erro ao cadastrar cliente: " . mysqli_error($conexao);
			$_SESSION['tipo_mensagem'] = "danger";
		}
	}
	
	mysqli_close($conexao);
	header("Location: ?page=listar-cliente");
	exit;
?>

