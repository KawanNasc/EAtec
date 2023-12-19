<?php session_start(); $host = "localhost:3306"; $usuario = "root"; $senha = ""; $bd = "PortalNoticias"; $conexao = mysqli_connect($host, $usuario, $senha, $bd);

	$statusRegistro = "Cadastrar/Entrar"; $statusAction = "cadastrologin";

	if ( isset($_POST["nome"]) &&
		 isset($_POST["nick"]) &&
		 isset($_POST["email"]) &&
		 isset($_POST["senha"]) &&
		 isset($_POST["nivelacesso"]) ) { 

		$nivelacesso = $_POST["nivelacesso"]; $nome = $_POST["nome"]; $nick = $_POST["nick"]; $email = $_POST["email"]; $senhaUsu = $_POST["senha"];

		$verificarCadastrado = mysqli_query($conexao, "SELECT * 
													   FROM usuario 
													   WHERE nmCompl_usu = '$nome' AND perm_usu = 1");
													   
		if ( mysqli_num_rows($verificarCadastrado) == 0 ) { $statusRegistro = "Aguarde a permissão do administrador"; $statusAction = "cadastrologin"; mysqli_query($conexao, "INSERT INTO usuario(nv_usu, nmCompl_usu, nick_usu, email_usu, senha_usu, perm_usu) VALUES('$nivelacesso', '$nome', '$nick', '$email', '$senhaUsu', 0);"); }
		else if ( mysqli_num_rows($verificarCadastrado) >= 1 ) { header("Location: index.php"); }

		$_SESSION["nivacesso"] = $nivelacesso;  $_SESSION["nome"] = $nome; $_SESSION["nick"] = $nick; $_SESSION["email"] = $email; $_SESSION["senha"] = $senha;

	}
	
?>

<!DOCTYPE html>

	<html lang="pt-br">

		<head>

			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" 
				  content="IE=edge,
				  		   chrome=1"> 

			<meta name="viewport" 
				  content="width=device-width, 
				  		   initial-scale=1.0">

			<title>Portal de Notícias</title>

			<meta name="description" content="Login" />
			<meta name="keywords" content="Login" />
			<meta name="author" content="Armstrong and Kawan" />
			
			<link href="BS/CSS/bootstrap.min.css" rel="stylesheet">
			<link href="BS/CSS/bootstrap-theme.min.css" rel="stylesheet">
			<link href="BS/CSS/theme.css" rel="stylesheet">
			<link href="BS/CSS/manjolo.css" rel="stylesheet">
			<script src="BS/JS/ie-emulation-modes-warning.js"></script>
			<script src="js/modernizr.custom.63321.js"></script>

			<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair:wght@300&display=swap" rel="stylesheet">

			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

			<style>

				body { font-family: 'Noto Serif', serif; text-align: center; background-color: black; color: white; }

                h1 { font-family: 'Anton', sans-serif; }

			</style>

			<title>Cadastro e Login</title>
			
		</head>

		<body>
					
			<div class="col-sm-9 col-md-9">

				<div class="panel panel-default panel-table">

					<div class="panel-heading">

						<div class="row">

							<div class="col col-xs-6"> <img src="IMG/jornal.png" widht=16 height=30> <h3 class="panel-title"> Cadastrar ou logar </h3> </div>

							<div class="col col-xs-6 text-right">

						</div>

					</div>

				</div>

				</div>

				<div class="form">

					<div class="row">

						<div class="col-md-12">

							<form action="<?= $statusAction ?>.php" class="form-horizontal" method="POST">
										
									<div class="col-sm-12">

										<div class="form-group">

											<div class="col-sm-4"> Nome completo: <input type="text" class="input-sm form-control" name="nome" placeholder="Nome Completo" maxlength=70 required autofocus> </div>
											<div class="col-sm-4"> Nick: <input type="text" class="input sm form-control" name="nick" placeholder="Usuário" maxlength="30" required> </div>
											<div class="col-sm-4"> E-Mail: <input type="text" class="input sm form-control" name="email" placeholder="Usuário" maxlength="50" required> </div>

											<div class="col-sm-4"> Nivel de Acesso:

												<select class="input sm form-control" name="nivelacesso" required>
													<option value="" selected disabled>Selecione aqui</option>
													<option value="Basico">Assinatura Basica R$2,00</option>
													<option value="Premium">Assinatura Premium R$10,00</option>
													<option value="Jornalista">Jornalista</option>
													<option value="Administrador">Administrador</option>
												</select>

											</div>
											
										</div>

									</div>
									
									<div class="col-sm-12">

											<div> Senha:
												<input type="password" class="input sm form-control" name="senha" placeholder="Senha" maxlength=50 required>
											</div>

											<br>
											
											<div> Confirmar senha:
												<input type="password" class="input sm form-control" name="confirmacao" placeholder="Confirme a Senha" maxlength=50 required>
											</div>

									</div>
								
					
									<div class="col-sm-12">

										<div class="form-group">				

											<div class="col-sm-12 col col-xs-12 text-right"> <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-disk"></span> <?= $statusRegistro ?> </button> </div>

										</div>
									</div>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
					integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
					crossorigin="anonymous">
			</script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
					integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
					crossorigin="anonymous">
			</script>
			
		</body>

	</html>

<?php mysqli_close($conexao); ?>