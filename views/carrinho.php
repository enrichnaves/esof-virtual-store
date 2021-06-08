<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Carrinho</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/index.css">
    <script src="../lib/js/carrinho.js"></script>
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black;color: white;">
    <!--*******************************MENU*******************************-->
    <?php
        include_once "./navbar.php";
        user_navbar();
    ?>    
    <!--*******************************FIM--MENU*************************************-->
    <section class = "container">
            <div class = "ca-geral">
                <div class = "padding">
                    <div class = "ca-titulo">
                        <p><h3>Os itens que você escolheu...</h3></p>
                    </div>
                </div>
                    <table id="listTable" class = "table" style="color: white;">
                        <tbody>
                            <tr>
                                <td>Seu Carrinho está vazio!</td>
                            </tr>
                        </tbody>
                    </table>
                <h4 class="text-center text-success">Total: <span id="totalValue">$ 0,00</span></h4>
                <a class="btn btn-primary cards_style"  onclick="limpar(1)">Limpar carrinho</a>
                <a class="btn btn-primary cards_style"  onclick="finalizar()">Finalizar</a>
            </div>
        </section>
        <?php
        footer();
        ?>
        
</body>
</html>