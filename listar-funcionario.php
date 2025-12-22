<?php
	session_start();
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	
	if (!$conexao) {
		die("Erro na conexão: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM funcionario ORDER BY id_funcionario DESC";
	$resultado = mysqli_query($conexao, $sql);
	$num_registros = 0;
	$erro = null;
	
	if (!$resultado) {
		$erro = "Erro ao buscar funcionários: " . mysqli_error($conexao);
	} else {
		$num_registros = mysqli_num_rows($resultado);
	}
	
	mysqli_close($conexao);
?>

<h1>Listar Funcionários</h1>

<?php if (isset($_SESSION['mensagem'])): ?>
	<div class="alert alert-<?php echo $_SESSION['tipo_mensagem']; ?> alert-dismissible fade show" role="alert">
		<?php 
			echo $_SESSION['mensagem'];
			unset($_SESSION['mensagem']);
			unset($_SESSION['tipo_mensagem']);
		?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<?php if (isset($erro)): ?>
	<div class="alert alert-danger" role="alert">
		<?php echo $erro; ?>
	</div>
<?php elseif ($num_registros > 0): ?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Email</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($funcionario = mysqli_fetch_assoc($resultado)): ?>
					<tr>
						<td><?php echo $funcionario['id_funcionario'] ?? ''; ?></td>
						<td><?php echo htmlspecialchars($funcionario['nome_funcionario'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($funcionario['telefone_funcionario'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($funcionario['email_funcionario'] ?? ''); ?></td>
						<td>
							<a href="?page=editar-funcionario&id=<?php echo $funcionario['id_funcionario']; ?>" class="btn btn-sm btn-warning">Editar</a>
							<a href="?page=excluir-funcionario&id=<?php echo $funcionario['id_funcionario']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">Excluir</a>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<p class="text-muted">Total de funcionários: <?php echo $num_registros; ?></p>
<?php else: ?>
	<div class="alert alert-info" role="alert">
		Nenhum funcionário cadastrado.
	</div>
<?php endif; ?>

<a href="?page=cadastrar-funcionario" class="btn btn-primary">Cadastrar Novo Funcionário</a>