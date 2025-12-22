<h1>Editar Cliente</h1>

<?php
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	$id_cliente = $_GET['id'] ?? 0;
	$cliente = null;

	if ($id_cliente > 0) {
		$resultado = mysqli_query($conexao, "SELECT * FROM cliente WHERE id_cliente = $id_cliente");
		$cliente = mysqli_fetch_assoc($resultado);
	}
?>

<div class="row">
	<div class="col-md-6">
		<?php if ($cliente): ?>
		<form method="POST" action="?page=salvar-cliente">
			<input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
			<div class="mb-3">
				<label class="form-label">Nome:</label>
				<input type="text" class="form-control" name="nome_cliente" value="<?php echo htmlspecialchars($cliente['nome_cliente']); ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">CPF:</label>
				<input type="text" class="form-control" name="cpf_cliente" value="<?php echo htmlspecialchars($cliente['cpf_cliente']); ?>" maxlength="11">
			</div>
			<div class="mb-3">
				<label class="form-label">Email:</label>
				<input type="email" class="form-control" name="email_cliente" value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Telefone:</label>
				<input type="text" class="form-control" name="telefone_cliente" value="<?php echo htmlspecialchars($cliente['telefone_cliente']); ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Endereço:</label>
				<input type="text" class="form-control" name="endereco_cliente" value="<?php echo htmlspecialchars($cliente['endereco_cliente']); ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Data de Nascimento:</label>
				<input type="date" class="form-control" name="dt_nasc_cliente" value="<?php echo $cliente['dt_nasc_cliente']; ?>">
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?page=listar-cliente" class="btn btn-secondary">Cancelar</a>
		</form>
		<?php else: ?>
		<div class="alert alert-danger">Cliente não encontrado!</div>
		<a href="?page=listar-cliente" class="btn btn-secondary">Voltar</a>
		<?php endif; ?>
	</div>
</div>

<?php mysqli_close($conexao); ?>
