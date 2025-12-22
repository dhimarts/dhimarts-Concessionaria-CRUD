<h1>Editar Funcionário</h1>

<?php
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	$id_funcionario = $_GET['id'] ?? 0;
	$funcionario = null;

	if ($id_funcionario > 0) {
		$resultado = mysqli_query($conexao, "SELECT * FROM funcionario WHERE id_funcionario = $id_funcionario");
		$funcionario = mysqli_fetch_assoc($resultado);
	}
?>

<div class="row">
	<div class="col-md-6">
		<?php if ($funcionario): ?>
		<form method="POST" action="?page=salvar-funcionario">
			<input type="hidden" name="id_funcionario" value="<?php echo $funcionario['id_funcionario']; ?>">
			<div class="mb-3">
				<label class="form-label">Nome:</label>
				<input type="text" class="form-control" name="nome_funcionario" value="<?php echo htmlspecialchars($funcionario['nome_funcionario']); ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Telefone:</label>
				<input type="text" class="form-control" name="telefone_funcionario" value="<?php echo htmlspecialchars($funcionario['telefone_funcionario']); ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Email:</label>
				<input type="email" class="form-control" name="email_funcionario" value="<?php echo htmlspecialchars($funcionario['email_funcionario']); ?>">
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?page=listar-funcionario" class="btn btn-secondary">Cancelar</a>
		</form>
		<?php else: ?>
		<div class="alert alert-danger">Funcionário não encontrado!</div>
		<a href="?page=listar-funcionario" class="btn btn-secondary">Voltar</a>
		<?php endif; ?>
	</div>
</div>

<?php mysqli_close($conexao); ?>
