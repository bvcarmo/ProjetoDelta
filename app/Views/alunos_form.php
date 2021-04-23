<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<link href="./../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="./../../assets/bootstrap/js/bootstrap.min.js"></script>
	<style>

		section {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}

		p {
			font-weight: bold;
			margin-bottom: 20px;
		}

		input {
			margin-bottom: 20px;
		}

		.toastr-disappear-success{
			opacity: 0;
			background-color: #007315;
		}

		.toastr-disappear-error{
			opacity: 0;
			background-color: #DF2700;
		}

		.foto {
			margin: 50px;
			height: 200px;
			width: 200px;
		}

		.hidden-foto {
			display: none;
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
			transition: opacity 4s;
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
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="fotoAntiga" value="<?php echo(isset($aluno) ? $aluno->nomeImagem : '')?>" />
			<p>Nome:</p>
			<input type="text" required name="nome" value="<?php echo(isset($aluno) ? $aluno->nome : '')?>" class="form-control"/>
			<p>Endereço:</p>
			<input type="text" required name="endereco" value="<?php echo(isset($aluno) ? $aluno->endereco : '')?>" class="form-control"/>
			<p id="carregar-foto" class="<?php echo(isset($aluno) ? 'hidden-foto' : '')?>">Foto: <input type="file" name="imagem" id="imagem"/></p>
			<input type="submit" value="<?php echo $acao ?>" />
		</form>
		<?php if(isset($aluno)){ ?> 
			<div id="div-foto">
				<img src="/uploads/<?php echo $aluno->nomeImagem; ?>" class="thumbnail foto"/>
				<button class="btn btn-primary" onclick="trocarFoto()">
					Escolher outra foto
				</button>
			</div>
		<?php } ?>
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

	function trocarFoto(){

		document.getElementById('div-foto').style.display = "none";
		document.getElementById('carregar-foto').style.display = "block";
		document.getElementById('imagem').click();
		document.getElementById('fotoAntiga').value = "";

	}
</script>

</body>
</html>
