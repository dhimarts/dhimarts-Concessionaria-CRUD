<?php
	session_start();
	$conexao = mysqli_connect("localhost", "root", "", "concessionaria2122m");
	
	if (!$conexao) {
		die("Erro na conexão: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM cliente ORDER BY id_cliente DESC";
	$resultado = mysqli_query($conexao, $sql);
	$num_registros = 0;
	$erro = null;
	
	if (!$resultado) {
		$erro = "Erro ao buscar clientes: " . mysqli_error($conexao);
	} else {
		$num_registros = mysqli_num_rows($resultado);
	}
	
	mysqli_close($conexao);
?>

<h1>Listar Clientes</h1>

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
					<th>CPF</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Endereço</th>
					<th>Data Nasc.</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($cliente = mysqli_fetch_assoc($resultado)): ?>
					<tr>
						<td><?php echo $cliente['id_cliente'] ?? ''; ?></td>
						<td><?php echo htmlspecialchars($cliente['nome_cliente'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($cliente['cpf_cliente'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($cliente['email_cliente'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($cliente['telefone_cliente'] ?? ''); ?></td>
						<td><?php echo htmlspecialchars($cliente['endereco_cliente'] ?? ''); ?></td>
						<td><?php echo $cliente['dt_nasc_cliente'] ? date('d/m/Y', strtotime($cliente['dt_nasc_cliente'])) : ''; ?></td>
						<td>
							<a href="?page=editar-cliente&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-warning">Editar</a>
							<a href="?page=excluir-cliente&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<p class="text-muted">Total de clientes: <?php echo $num_registros; ?></p>
<?php else: ?>
	<div class="alert alert-info" role="alert">
		Nenhum cliente cadastrado.
	</div>
<?php endif; ?>

<a href="?page=cadastrar-cliente" class="btn btn-primary">Cadastrar Novo Cliente</a>