<?php
        session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Home</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/index.css">
    <script src="../lib/js/carrinho.js"></script>
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black;">
    <?php
        include_once "./navbar.php";
        include_once "../controllers/bd_connection.php";
        
        user_navbar();

        $sql = "SELECT * from produto;";
        $fetch = pg_exec($conexao, $sql);
    echo '
    <!--*******************************BANNER*******************************-->
    <img src="./img/loja.png" style="width:100%;height: 450px;" title="Banner">
    <!--*******************************FIM-BANNER*******************************-->

    <!--*******************************CARDS*******************************-->
    ';
    echo '
    <a class="btn btn-primary" href="#" style="background: none; margin-top: 100px;">Produtos</a>
    <div class="container" style="margin-top: 10%;">
        <div class="row blog ">
            <div class="col-md-12">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">';
    while ($row = pg_fetch_row($fetch))
    {
                            echo'
                            <div class="col col-md-3">
                                    <div class="card">
                                    <div class="card text-center">
                                    <p><img class="img-fluid" src="./img/loja.png" alt="card image"></p>';
                                            for ($i = 1; $i < sizeof($row); $i++)
                                            {
                                            echo '<h5 class="titulo">
                                                '.$row[$i].'
                                            </h5>';
                                            }
                                        echo '</div>
                                            <p>
                                                <a class="btn btn-primary cards_style"  onclick="addCarrinho(\''.$row[1].'\',\''. $row[2].'\',\''.$row[0].'\')">Comprar</a>
                                            </p>
                                </div>
                            </div>';
                                        }
                        echo '</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       '; 
    ?>   
    <!--*******************************FIM-CARDS*******************************-->

    <div class="jumbotron jumbotron-fluid " style="margin-bottom: auto; background-color: #220ce0; height: 650px; ">
        <div class="container ">
            
            <div class="row">
                <div class="col-12 text-center" style="color: white; height: 180px;">
                    <h1 class="text-center ">Dicas</h1>
                    <p class="lead">Quer saber sobre as novidades de 2020 ? Confira nossa dica !!
                    </p>
                    <hr style=" background-color: white;">
                </div>

                <div class="tab-content " id="nav-pills-content">

                    <div class="tab-pane fade show active" id="nav-item-01">
                        <div class="row">
                        
                            <div class="col-sm-6">
                                <div class=" mt-3 embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/YZqB3Kg3oAY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3 text ">
                                <h1 class="text-center list-group-item-success" style="background: white;"> Descrição </h1>
                                <p class="text-justify mt-5">
                                    <strong> Quer dicas dos melhores produtos custo benefício de 2020 ? Quais os que contém a melhor qualidade?  
                                        Indicamos este vídeo para que vocês tenham uma noção dos melhores lançamentos de 2020!!! </strong>
                                </p>
                            </div>
                            <div class="col-sm-6 mt-3 text ">
                                <h1 class="text-center list-group-item-success" style="background: white;">  </h1>
                                <p class="text-justify mt-5">
                                    
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php
            footer();
            ?>
        </div>
</body>
</html>