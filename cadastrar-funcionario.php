<h1>Cadastrar Funcionário</h1>

<div class="row">
	<div class="col-md-6">
		<form method="POST" action="?page=salvar-funcionario">
			<div class="mb-3">
				<label class="form-label">Nome:</label>
				<input type="text" class="form-control" name="nome_funcionario" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Telefone:</label>
				<input type="text" class="form-control" name="telefone_funcionario">
			</div>
			<div class="mb-3">
				<label class="form-label">Email:</label>
				<input type="email" class="form-control" name="email_funcionario">
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?page=listar-funcionario" class="btn btn-secondary">Cancelar</a>
		</form>
	</div>
</div>
