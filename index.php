<?php session_start(); $host = "localhost:3306"; $usuario = "root"; $senha = ""; $bd = "PortalNoticias"; $conexao = mysqli_connect($host, $usuario, $senha, $bd); ?> 
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
                  rel="stylesheet" ''
                  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
                  crossorigin="anonymous">

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair:wght@300&display=swap" rel="stylesheet">
            
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

            <title>Notícias Esportivas</title>

            <style>

                body { font-family: 'Noto Serif', serif; text-align: center; background-color: black; color: white; }

                h1, h2 { font-family: 'Anton', sans-serif; margin-top: 4%; margin-bottom: 2%; text-shadow: 2px 2px }

                .container { display: flex; justify-content: space-around; width: 180%; flex-wrap: wrap; }

                .noticia { width: 45%; border: 1px solid #ccc; padding: 10px; margin: 1%;  text-align: center; }

                .imgnoticias { width: 430px; height: 280px; }

            </style>

        </head>

        <body>

            <nav class="navbar" style="background-color: #e3f2fd;">

                <div class="container-fluid">

                    <a class="navbar-brand" href="#"> <img src="IMG/jornal.png" widht=16 height=30>  O seu portal de Noticias </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav">

                            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#"> Home </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="cadastrologin.php"> Cadastrar/Entrar </a> </li>
                            <?php 
                                if ( $_SESSION["nivacesso"] == "Premium" ) { echo "<li class='nav-item'> <a class='nav-link' href='EAtec/index.php'> Acesse o nosso portal de jogos com o benefício premium! </a> </li>"; }
                                else if ( $_SESSION["nivacesso"] == "Jornalista" ) { echo "<li class='nav-item'> <a class='nav-link' href='postagens.php'> Poste a sua notícia </a> </li>"; } 
                                else if ( $_SESSION["nivacesso"] == "Administrador" ) { echo "<li class='nav-item'> <a class='nav-link' href='permissoes.php'> Gerencie as permissões do cadastro dos usuários e notícias dos usuários </a> </li>"; }
                            ?>

                        </ul>

                    </div>

                </div>

            </nav>

            <h2 style="color: firebrick;">Fórmula 1</h2>

            <div id="carouselExampleCaptionsF1" class="carousel slide">
                
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptionsF1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                    
                    <?php $selectNoticiasF1 = mysqli_query($conexao, "SELECT * FROM noticia WHERE perm_not = 1 AND esp_not = 'Formula1'");

                         for ( $botoesF1 = 1; $botoesF1 <= mysqli_num_rows($selectNoticiasF1); $botoesF1++) {

                            echo "<button type='button' data-bs-target='#carouselExampleCaptionsF1' data-bs-slide-to='" . $botoesF1 . "' aria-label='Slide " . $botoesF1 + 1 . "'> </button>";

                        }

                    ?>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class='imgnoticias' style="margin-left: 40%;"> <img src="IMG/f1_capa.jpg" class="d-block w-10" alt="..."> </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: firebrick;">Confira as principais notícias de F1</h5>
                        </div>
                    </div>
                    <?php

                        while ( $escreverNoticiasF1 = mysqli_fetch_array($selectNoticiasF1) )  {

                            echo "<div class='carousel-item'>";
                                echo "<div class='container'>";
                                echo "<img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasF1["img_not"] . "' class='d-block w-10' alt='...'>";
                                echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<h5 style='color: firebrick;'>" . $escreverNoticiasF1["titu_not"] .  " </h5>";
                                    echo "<p style='color: firebrick;'>" . $escreverNoticiasF1["descr_not"] .  " </p>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsF1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsF1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

            <div class="container">
                <?php
                    // Array simulando notícias da Fórmula 1
                    $noticias_formula1 = array(
                        "Hamilton cita final de Interlagos-2008 'judicializada' por Massa e relembra o pós-título: 'Me senti o inimigo público nº1' <img class='img' src='IMG/Noticias/interlagos08.png'>",
                        "Alonso na Red Bull? Pérez fora? Aston à venda? Entenda rumores recentes do paddock da F1 <img class='img' src='IMG/Noticias/rumores.png'>",
                        "Horner 'não culpa' Pérez pela manobra na largada do GP do México <img class='img' src='IMG/Noticias/manobra.png'>",
                        "Quarto no grid, Ricciardo diz que se sentiu 'como o velho Daniel' <img class='img' src='IMG/Noticias/ricciardo.png'>",
                        "Dupla da Ferrari 'chocada' com pole e 1°fila no GP da Cidade do México. <img class='img' src='IMG/Noticias/ferrari.png'>"
                    );

                    // Exibe as notícias na página
                    foreach ($noticias_formula1 as $noticia) {
                        echo '<div class="noticia">';
                            echo '<h3>' . $noticia . '</h3>';
                            echo '<p>Descrição da notícia sobre ' . substr($noticia, 0, strpos($noticia, " ")) . '...</p>';
                        echo '</div>';
                    }

                ?>
            </div>

            <h2 style="color: greenyellow;"> Futebol </h2>
            
            <div id="carouselExampleCaptionsFut" class="carousel slide">
                
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptionsFut" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                    
                    <?php $selectNoticiasFut = mysqli_query($conexao, "SELECT * FROM noticia WHERE perm_not = 1 AND esp_not = 'Futebol'");

                         for ( $botoesFut = 1; $botoesFut <= mysqli_num_rows($selectNoticiasFut); $botoesFut++) {

                            echo "<button type='button' data-bs-target='#carouselExampleCaptionsFut' data-bs-slide-to='" . $botoesFut . "' aria-label='Slide " . $botoesFut + 1 . "'> </button>";

                        }

                    ?>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class='imgnoticias' style="margin-left: 40%;"> <img src="IMG/futcapa.png" class="d-block w-10" alt="..."> </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: greenyellow;">Confira as principais notícias de Futebol</h5>
                        </div>
                    </div>
                    <?php

                        while ($escreverNoticiasFut = mysqli_fetch_array($selectNoticiasFut))  {

                            echo "<div class='carousel-item'>";
                                echo "<div class='container'>";
                                echo "<img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasFut["img_not"] . "' class='d-block w-10' alt='...'>";
                                echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<h5 style='color: firebrick;'>" . $escreverNoticiasFut["titu_not"] .  " </h5>";
                                    echo "<p style='color: firebrick;'>" . $escreverNoticiasFut["descr_not"] .  " </p>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsFut" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsFut" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
            
            <div class="container">
                <?php
                    // Array simulando notícias de Futebol
                    $noticias_futebol = array(
                        "Copa do Mundo 2034: presidente da Fifa confirma Arábia Saudita como sede <img class='img' src='IMG/Noticias/arabiasaudita.png'>",
                        "Cristiano Ronaldo reage a publicação que critica Bola de Ouro de Messi <img class='img' src='IMG/Noticias/boladeouro.png'>",
                        "Felipe Alves recebe sondagens e deve puxar barca do São Paulo <img class='img' src='IMG/Noticias/felipealves.png'>",
                        "Seneme diz que imagem é inconclusiva em possível toque de mão no gol do Cuaibá contra o Botafogo <img class='img' src='IMG/Noticias/seneme.png'>",
                        "Júlio Brant retira candidatura e vai apoiar Pedrinho na eleição do Vasco <img class='img' src='IMG/Noticias/juliobrant.png'>"
                    );

                    // Exibe as notícias na página
                    foreach ($noticias_futebol as $noticia) {
                        echo '<div class="noticia">';
                            echo '<h3>' . $noticia . '</h3>';
                            echo '<p>Descrição da notícia sobre ' . substr($noticia, 0, strpos($noticia, " ")) . '...</p>';
                        echo '</div>';
                    }

                    while ($escreverNoticiasFut = mysqli_fetch_array($selectNoticiasFut))  {

                        echo "<div class='noticia'>";
                            echo "<p> " . $escreverNoticiasFut["titu_not"] . " </p>";
                            echo "<p> <img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasFut["img_not"] . "'> </p>";
                            echo "<p> " . $escreverNoticiasFut["descr_not"] . " </p>";
                        echo '</div>';

                    }
                ?>
            </div>

            <h2 style="color: goldenrod;"> Vôlei </h2>

            <div id="carouselExampleCaptionsVolei" class="carousel slide">
                
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptionsVolei" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                    
                    <?php $selectNoticiasVolei = mysqli_query($conexao, "SELECT * FROM noticia WHERE perm_not = 1 AND esp_not = 'Võlei'");

                         for ( $botoesVolei = 1; $botoesVolei <= mysqli_num_rows($selectNoticiasVolei); $botoesVolei++ ) {

                            echo "<button type='button' data-bs-target='#carouselExampleCaptionsVolei' data-bs-slide-to='" . $botoesVolei . "' aria-label='Slide " . $botoesVolei + 1 . "'> </button>";

                        }

                    ?>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class='imgnoticias' style="margin-left: 40%;"> <img src="IMG/voleicapa.png" class="d-block w-10" alt="..."> </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: goldenrod;">Confira as principais notícias de Volêi</h5>
                        </div>
                    </div>
                    <?php

                        while ($escreverNoticiasVolei = mysqli_fetch_array($selectNoticiasVolei))  {

                            echo "<div class='carousel-item'>";
                                echo "<div class='container'>";
                                echo "<img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasVolei["img_not"] . "' class='d-block w-10' alt='...'>";
                                echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<h5 style='color: firebrick;'>" . $escreverNoticiasVolei["titu_not"] .  " </h5>";
                                    echo "<p style='color: firebrick;'>" . $escreverNoticiasVolei["descr_not"] .  " </p>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsVolei" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsVolei" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

            <div class="container">
                <div class="noticia">
                    <h3> Pan 2023: Brasil domina o México e se aproxima da semifinal no vôlei </h3>
                    <p>Descrição da notícia sobre a vitória de Lewis Hamilton em Monza...</p>
                    <img class='imgnoticias' src="IMG/Noticias/panvolei.png">
                </div>

                <div class="noticia">
                    <h3> Zé Roberto assume como coordenador técnico das seleções </h3>
                    <p> Descrição da notícia sobre a pole position de Max Verstappen no Brasil...</p>
                    <img class='imgnoticias' src="IMG/Noticias/joseroberto.png">
                </div>
            </div>

            <h2 style="color: orange;"> Basquete </h2>

            <div id="carouselExampleCaptionsBasquete" class="carousel slide">
                
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptionsBasquete" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                    
                    <?php $selectNoticiasBasquete = mysqli_query($conexao, "SELECT * FROM noticia WHERE perm_not = 1 AND esp_not = 'Basquete'");

                         for ( $botoesBasquete = 1; $botoesBasquete <= mysqli_num_rows($selectNoticiasBasquete); $botoesBasquete++ ) {

                            echo "<button type='button' data-bs-target='#carouselExampleCaptionsBasquete' data-bs-slide-to='" . $botoesBasquete . "' aria-label='Slide " . $botoesBasquete + 1 . "'> </button>";

                        }

                    ?>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class='imgnoticias' style="margin-left: 40%;"> <img src="IMG/basqcapa.png" class="d-block w-10" alt="..."> </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: orange;">Confira as principais notícias de Basquete</h5>
                        </div>
                    </div>
                    <?php

                        while ($escreverNoticiasBasquete = mysqli_fetch_array($selectNoticiasBasquete))  {

                            echo "<div class='carousel-item'>";
                                echo "<div class='container'>";
                                echo "<img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasBasquete["img_not"] . "' class='d-block w-10' alt='...'>";
                                echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<h5 style='color: firebrick;'>" . $escreverNoticiasBasquete["titu_not"] .  " </h5>";
                                    echo "<p style='color: firebrick;'>" . $escreverNoticiasBasquete["descr_not"] .  " </p>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsBasquete" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsBasquete" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

            <div class="container">
                <div class="noticia">
                    <h3> Curry vai à loucura com sequência de dribles em cima de Brooks </h3>
                    <p> Descrição da notícia sobre a vitória de Lewis Hamilton em Monza... </p>
                    <img class='imgnoticias' src="IMG/Noticias/curry.png">
                </div>

                <div class="noticia">
                    <h3> LeBron impressiona em decolagem e é decisivo no reencontro com Durant </h3>
                    <p> Descrição da notícia sobre a pole position de Max Verstappen no Brasil...</p>
                    <img class='imgnoticias' src="IMG/Noticias/lebron.png">
                </div>

            </div>

            <h2 style="color: gold;"> Surf </h2>

            <div id="carouselExampleCaptionsSurf" class="carousel slide">
                
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptionsurf" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                    
                    <?php $selectNoticiasSurf = mysqli_query($conexao, "SELECT * FROM noticia WHERE perm_not = 1 AND esp_not = 'Surf'");

                         for ( $botoesSurf = 1; $botoesSurf <= mysqli_num_rows($selectNoticiasSurf); $botoesSurf++ ) {

                            echo "<button type='button' data-bs-target='#carouselExampleCaptionsSurf' data-bs-slide-to='" . $botoesSurf . "' aria-label='Slide " . $botoesSurf + 1 . "'> </button>";

                        }

                    ?>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class='imgnoticias' style="margin-left: 40%;"> <img src="IMG/surfcapa.png" class="d-block w-10" alt="..."> </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: gold;">Confira as principais notícias de Surf</h5>
                        </div>
                    </div>
                    <?php

                        while ($escreverNoticiasSurf = mysqli_fetch_array($selectNoticiasSurf))  {

                            echo "<div class='carousel-item'>";
                                echo "<div class='container'>";
                                echo "<img class='imgnoticias' src='IMG/Noticias/" . $escreverNoticiasSurf["img_not"] . "' class='d-block w-10' alt='...'>";
                                echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<h5 style='color: firebrick;'>" . $escreverNoticiasSurf["titu_not"] .  " </h5>";
                                    echo "<p style='color: firebrick;'>" . $escreverNoticiasSurf["descr_not"] .  " </p>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsSurf" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsSurf" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

            <div class="container">
                <div class="noticia">
                    <h3> Samuel Pupo é campeão em Saquarema </h3>
                    <p> Descrição da notícia sobre a vitória de Lewis Hamilton em Monza... </p>
                    <img class='imgnoticias' src="IMG/Noticias/samuelpupo.png">
                </div>

                <div class="noticia">
                    <h3> Italo Ferreira exibe imagens que viralizaram do eclipse </h3>
                    <p> Descrição da notícia sobre a pole position de Max Verstappen no Brasil... </p>
                    <img class='imgnoticias' src="IMG/Noticias/eclipse.png">
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