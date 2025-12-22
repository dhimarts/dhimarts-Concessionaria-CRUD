<h1>Cadastrar Cliente</h1>

<div class="row">
	<div class="col-md-6">
		<form method="POST" action="?page=salvar-cliente">
			<div class="mb-3">
				<label class="form-label">Nome:</label>
				<input type="text" class="form-control" name="nome_cliente" required>
			</div>
			<div class="mb-3">
				<label class="form-label">CPF:</label>
				<input type="text" class="form-control" name="cpf_cliente" maxlength="11">
			</div>
			<div class="mb-3">
				<label class="form-label">Email:</label>
				<input type="email" class="form-control" name="email_cliente">
			</div>
			<div class="mb-3">
				<label class="form-label">Telefone:</label>
				<input type="text" class="form-control" name="telefone_cliente">
			</div>
			<div class="mb-3">
				<label class="form-label">Endereço:</label>
				<input type="text" class="form-control" name="endereco_cliente">
			</div>
			<div class="mb-3">
				<label class="form-label">Data de Nascimento:</label>
				<input type="date" class="form-control" name="dt_nasc_cliente">
			</div>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?page=listar-cliente" class="btn btn-secondary">Cancelar</a>
		</form>
	</div>
</div>
