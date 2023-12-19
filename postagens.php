<?php session_start(); $host = "localhost:3306"; $usuario = "root"; $senha = ""; $bd = "PortalNoticias"; $conexao = mysqli_connect($host, $usuario, $senha, $bd); ?>
<?//php if ( $_SESSION["nivacesso"] != "Jornalista" ) { header("Location: index.php"); exit(); } ?>
<?//php if ( $_SESSION["nivacesso"] == null ) { header("Location: cadastrologin.php"); exit(); } ?>

<!DOCTYPE html>

    <html lang="pt-br">

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" 
                  content="width=device-width, 
                           initial-scale=1.0">

            <meta name="description" content="Login" />
			<meta name="keywords" content="Login" />
			<meta name="author" content="Armstrong and Kawan" />

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
				  rel="stylesheet" 
				  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
				  crossorigin="anonymous">

			<link rel=”stylesheet” 
				  href=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css” 
				  integrity=”sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB” 
				  crossorigin=”anonymous”>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair:wght@300&display=swap" rel="stylesheet">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

            <style>

                body { font-family: 'Noto Serif', serif; text-align: center; background-color: black; color: white; }

                h1 { font-family: 'Anton', sans-serif; margin-top: 5%; margin-bottom: 5%; }

                .container { display: flex; justify-content: space-around; }

                .noticia { width: 90%; border: 1px solid #ccc; padding: 10px; margin: 10px; }

                .input { margin: 20px; }

            </style>
            
            <title>Editorial</title>

        </head>

        <body>

            <h1>Poste aqui sua notícia</h1>

            <form action='postagens.php' class='form-horizontal' method='POST' enctype="multipart/form-data">
                <div class='col-md-12'>
                    <div class='form-group'>
                        <div class="container">
                            <div class="noticia">
                                <div class="input"> <div class='col-sm-10'> <input type='text' class='input-sm form-control' name='titu' placeholder='Título da notícia' size=20 required autofocus> </div> </div>
                                <div class="input"> <div class='col-sm-10'> <input type='text' class='input sm form-control' name='descr' placeholder='Descrição da notícia' required> </div> </div>
                                <div class="input"> <div class='col-sm-10'> <input type='text' class='input sm form-control' name='corpo' placeholder='Corpo de texto da notícia' required> </div> </div>
                                <div class="input"> Esporte: 
                                <select name="esporte" required>
                                    <option value="" selected disabled>Selecione o esporte</option>
                                    <option value="Formula1">Fórmula 1</option>
                                    <option value="Futebol">Futebol</option>
                                    <option value="Vôlei">Vôlei</option>
                                    <option value="Basquete">Basquete</option>
                                    <option value="Surf">Surf</option>
                                </select> </div>
                                <div class="input"> <div class='col-sm-10'> <input type='file' class='input sm form-control' name='img' required> </div> </div>
                                <div class="input"> <div class='col-sm-10'> <input type='submit' class='input sm form-control' name='envio' value='Enviar notícia'> </div> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php

                if ( isset($_POST["titu"]) && 
                     isset($_POST["descr"]) && 
                     isset($_POST["corpo"]) && 
                     isset($_FILES["img"]) &&
                     isset($_POST["esporte"]) &
                     isset($_POST["envio"]) ) { 
                    
                    $autor = $_SESSION["nome"]; $titulo = $_POST["titu"]; $descricao = $_POST["descr"]; $corpo = $_POST["corpo"]; $imagem = $_FILES["img"]; $esporte = $_POST["esporte"];
                    $arqNovo = explode('.', $imagem["name"]);

                    if ( $arqNovo[sizeof($arqNovo)-1] == "png" || $arqNovo[sizeof($arqNovo)-1] == "jpg") { echo "Upload feito com sucesso!"; $fotoPronta = move_uploaded_file($imagem["tmp_name"], 'IMG/Noticias/' . $imagem["name"]); }
                    else { die("Apenas arquivos tipo png ou jpg"); }

                    $img = $imagem["name"];
                    mysqli_query($conexao, "INSERT INTO noticia(titu_not, descr_not, corpo_not, img_not, esp_not, perm_not, usu_not) VALUES('$titulo', '$descricao', '$corpo', '$img', '$esporte', 0, '$autor');");
                    
                }
                
            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
			<script src=”https://code.jquery.com/jquery-3.3.1.slim.min.js” integrity=”sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo” crossorigin=”anonymous”></script>
			<script src=”https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js” integrity=”sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49″ crossorigin=”anonymous”></script>
			<script src=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js” integrity=”sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T” crossorigin=”anonymous”></script>

        </body>

    </html>

<?php mysqli_close($conexao); ?>