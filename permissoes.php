<?php session_start(); $host = "localhost:3306"; $usuario = "root"; $senha = ""; $bd = "PortalNoticias"; $conexao = mysqli_connect($host, $usuario, $senha, $bd); ?>
<?php if ( $_SESSION["nivacesso"] != "Administrador" ) { header("Location: index.php"); exit(); } ?>
<?php if ( $_SESSION["nivacesso"] == null ) { header("Location: cadastrologin.php"); exit(); } ?>

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

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair:wght@300&display=swap" rel="stylesheet">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

            <style>

                body { font-family: 'Noto Serif', serif; text-align: center; background-color: black; color: white; }

                h1, h2 { font-family: 'Anton', sans-serif; margin-top: 2%; margin-bottom: 2%; }

                .tabelaUsuarios { background-color: rgb(255, 153, 102); border-style: dashed; width: 70%; justify-content: center; margin-left: 15%; margin-top: 5%;  }

                .container { display: flex; justify-content: space-around; width: 180%; flex-wrap: wrap; }

                .categorias, .usuario { display: flex; justify-content: space-around; width: 90%; }

                .noticia { width: 45%; border: 1px solid #ccc; padding: 10px; margin: 1%;  text-align: center; }

                img { width: 90%; justify-content: center; }

            </style>

            <title>Lista de usuários e notícias</title>

        </head>

        <body>

            <h1>Configurações de permissão: </h1>
            <form action="permissoes.php" method="post">

                <h2> Usuários em cadastro: </h2>
                <div class="tabelaUsuarios">

                    <div class="categorias">

                        <div class="categoria"> Código do usuário </div>
                        <div class="categoria"> Nível solicitado </div>
                        <div class="categoria"> Nome completo </div>
                        <div class="categoria"> Nick </div>
                        
                    </div>

                    <div class="container">
                    <?php

                        $selectUsuarios = mysqli_query($conexao, "SELECT cod_usu, nv_usu, nmCompl_usu, nick_usu
                                                                  FROM usuario
                                                                  WHERE perm_usu = 0;");

                        function identificarUsuario($codUsuario) { return "codigo" . $codUsuario;  }

                        while ( $escreverUsuarios = mysqli_fetch_array($selectUsuarios) ) { $codUsuario = $escreverUsuarios['cod_usu'];

                            echo "<div class='usuario'>" . 
                                    $escreverUsuarios["cod_usu"] . "" . 
                                    $escreverUsuarios["nv_usu"] . " " .
                                    $escreverUsuarios["nmCompl_usu"] . " " .
                                    $escreverUsuarios["nick_usu"] . " " .
                                    "Permitir acesso: <input type='radio' name='" . identificarUsuario($codUsuario) . "' value='aprovado'> " .
                                    "Rejeitar acesso: <input type='radio' name='" . identificarUsuario($codUsuario) . "' value='reprovado'>" .
                                "</div>";

                                if ( isset($_POST[identificarUsuario($codUsuario)])) { $assinale = $_POST[identificarUsuario($codUsuario)];

                                    if ( $assinale == "aprovado" ) { $updateVlrPerm = mysqli_query($conexao, "UPDATE usuario SET perm_usu = 1 WHERE cod_usu = '$codUsuario';"); }
                                    else if ( $assinale == "reprovado" ) { $updateVlrPerm = mysqli_query($conexao, "UPDATE usuario SET perm_usu = '-1' WHERE cod_usu = '$codUsuario';"); }
        
                                }

                        }

                    ?>
                    </div>
                </div>

                <h2> Notícias em aguarde da permissão: </h2>
                <div class="tabelaNoticias">

                    <div class="container">
                        <?php

                            $selectNoticias = mysqli_query($conexao, "SELECT noticia.cod_not, noticia.titu_not, noticia.descr_not, noticia.corpo_not, noticia.img_not, noticia.esp_not, usuario.nmCompl_usu
                                                                    FROM noticia
                                                                    JOIN usuario ON noticia.usu_not = usuario.nmCompl_usu
                                                                    WHERE perm_not = 0;");

                            function identificarNoticia($codNoticia) { return "codigo" . $codNoticia;  }
                            
                            while ($escreverNoticias = mysqli_fetch_array($selectNoticias))  { $codNoticia = $escreverNoticias['cod_not'];

                                echo "<div class='noticia'>" . 
                                        "<h2> " . $escreverNoticias["titu_not"] . " </h2>" .
                                        "<p> " . $escreverNoticias["descr_not"] . " </p>" .
                                        "<p> " . $escreverNoticias["corpo_not"] . " </p>" .
                                        "<img src='IMG/Noticias/". $escreverNoticias["img_not"] . "'>" .
                                        "<p> " . $escreverNoticias["esp_not"] . " </p>" .
                                        "<p> Autor: " . $escreverNoticias["nmCompl_usu"] . " </p>" .
                                        "Emitir no jornal: <input type='radio' name='" . identificarNoticia($codNoticia) . "' value='aprovado'>" .
                                        "Pedido para revisar: <input type='radio' name='" . identificarNoticia($codNoticia) .  "' value='reprovado'>" .
                                    "</div>";

                                if ( isset($_POST[identificarNoticia($codNoticia)])) { $assinale = $_POST[identificarNoticia($codNoticia)];

                                    if ( $assinale == "aprovado" ) { $updateVlrPerm = mysqli_query($conexao, "UPDATE noticia SET perm_not = 1 WHERE cod_not = '$codNoticia';"); }
                                    else if ( $assinale == "reprovado" ) { $updateVlrPerm = mysqli_query($conexao, "UPDATE noticia SET perm_not = '-1' WHERE cod_not = '$codNoticia';"); }

                                }
                                
                            }

                            ?>

                    </div>

                    <a href="index.php"> <input type='submit' value='Enviar permissão'> <button type='button' class='btn btn-primary'> Voltar para página principal </button> </a> 
                        
                </div>

            </form>    

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
			<script src=”https://code.jquery.com/jquery-3.3.1.slim.min.js” integrity=”sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo” crossorigin=”anonymous”></script>
			<script src=”https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js” integrity=”sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49″ crossorigin=”anonymous”></script>
			<script src=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js” integrity=”sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T” crossorigin=”anonymous”></script>

        </body>

    </html>

<?php mysqli_close($conexao); ?>