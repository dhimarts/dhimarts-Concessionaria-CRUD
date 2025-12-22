<?php
	session_start();
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	
	if (!$conexao) {
		$_SESSION['mensagem'] = "Erro na conexão com o banco de dados: " . mysqli_connect_error();
		$_SESSION['tipo_mensagem'] = "danger";
		header("Location: ?page=listar-funcionario");
		exit;
	}
	
	$id_funcionario = $_POST['id_funcionario'] ?? 0;
	$nome_funcionario = mysqli_real_escape_string($conexao, $_POST['nome_funcionario'] ?? '');
	$telefone_funcionario = mysqli_real_escape_string($conexao, $_POST['telefone_funcionario'] ?? '');
	$email_funcionario = mysqli_real_escape_string($conexao, $_POST['email_funcionario'] ?? '');

	if ($id_funcionario > 0) {
		$sql = "UPDATE funcionario SET 
				nome_funcionario = '$nome_funcionario',
				telefone_funcionario = '$telefone_funcionario',
				email_funcionario = '$email_funcionario'
				WHERE id_funcionario = $id_funcionario";
		
		if (mysqli_query($conexao, $sql)) {
			$_SESSION['mensagem'] = "Funcionário atualizado com sucesso!";
			$_SESSION['tipo_mensagem'] = "success";
		} else {
			$_SESSION['mensagem'] = "Erro ao atualizar funcionário: " . mysqli_error($conexao);
			$_SESSION['tipo_mensagem'] = "danger";
		}
	} else {

		$sql = "INSERT INTO funcionario (nome_funcionario, telefone_funcionario, email_funcionario) 
				VALUES ('$nome_funcionario', '$telefone_funcionario', '$email_funcionario')";
		
		if (mysqli_query($conexao, $sql)) {
			$_SESSION['mensagem'] = "Funcionário cadastrado com sucesso!";
			$_SESSION['tipo_mensagem'] = "success";
		} else {
			$_SESSION['mensagem'] = "Erro ao cadastrar funcionário: " . mysqli_error($conexao);
			$_SESSION['tipo_mensagem'] = "danger";
		}
	}
	
	mysqli_close($conexao);
	header("Location: ?page=listar-funcionario");
	exit;
?>

