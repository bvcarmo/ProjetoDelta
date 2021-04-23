<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<link href="./../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="./../assets/bootstrap/js/bootstrap.min.js"></script>
	<style>
		a {
			text-decoration: none;
			color: white;
		}

		a:hover {
			color: white;
		}

		section {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}

		table {
			text-align: center;
		}

		.fotoTabela {
			width: 40px;
			height: 40px;
		}

		.toastr-disappear-success{
			opacity: 0;
			background-color: #007315;
		}

		.toastr-disappear-error{
			opacity: 0;
			background-color: #DF2700;
		}

		#toastr {
			width: 30%;
			position: fixed;
			justify-content: right;
			height: 100px;
			z-index: 3;
			border-radius: 15px;
			top: 20px;
			right: 20px;
			transition: opacity 6s;
			padding: 30px;
		}

		#div-toastr {
			display: flex;
			flex-direction: row-reverse;
		}

		#msg {
			text-align: center;
			font-weight: bold;
		}
	
	</style>

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
		<a class="navbar-brand" href="<?php echo base_url('alunos/') ?>">Projeto Delta</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('alunos/') ?>">Lista de alunos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('alunos/inserir') ?>">Cadastrar</a>
			</li>
			</ul>
		</div>
	</nav>

	<div id="div-toastr">
		<div id="toastr">
			<p id="msg"><?php echo $msg ?></p>
		</div>
	</div>

	<section>
		<h1><?php echo $titulo; ?></h1>
		
		<table class="table table-hover">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Nome</th>
				<th scope="col">Endereço</th>
				<th scope="col">Foto</th>
				<th scope="col">*</th>
				<th scope="col">*</th>
			</tr>
			<?php foreach($alunos as $aluno): ?>
			<tr>
				<td><?php echo $aluno->id; ?></td>
				<td><?php echo $aluno->nome; ?></td>
				<td><?php echo $aluno->endereco; ?></td>
				<td><a href="./../uploads/<?php echo $aluno->nomeImagem; ?>" download="foto_<?php echo $aluno->nome; ?>"><img class="fotoTabela" src="./../uploads/<?php echo $aluno->nomeImagem; ?>" class="thumbnail" /></a></td>
				<td>
					<button class="btn btn-primary">
						<a href="<?php echo base_url('alunos/editar/'.$aluno->id) ?>">Editar</a>
					</button>
				</td>
				<td>
					<button class="btn btn-primary">
						<a href="<?php echo base_url('alunos/excluir/'.$aluno->id) ?>">Excluir</a></td>
					</button>
			</tr>
			<?php endforeach ?>
		</table>
	</section>

<script>
	<?php if($status != ""){ ?> 
		setTimeout(function(){
		
		let status = <?php echo $status ?>;
		
		if(status == 200){
			document.getElementById('toastr').className = 'toastr-disappear-success';
		}
		else{
			document.getElementById('toastr').className = 'toastr-disappear-error';
		}
		},10);
	<?php } ?>
</script>

</body>
</html>