<?php
    session_start();
    if((!isset ($_SESSION['usuario'])))
    {
        header("Location: ./login.php");
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pagamento</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src="../lib/js/js.js"></script>
    <script src="../lib/js/carrinho.js"></script>
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black;">
    
    <?php
        include_once "./navbar.php";
        user_navbar();
    
    echo '<a class="btn btn-primary barra" style="background: none;" href="#">Dados de pagamento:</a>';
    echo '
    <form id="finalizar_form">
        <div class="box">
            <div class="textbox">
                <p style="color: white;">Numero do cartão</p>
                <input type="text" placeholder="Número do cartão de crédito" name ="num_cartao" value="" minlength="19" oninput="mascaracartao(this)" required/>
            </div>
            <br>
            <div class="textbox">
                <p style="color: white;">Validade</p>
                <input type="date" placeholder="Validade" name ="data_cartao"  value="" required/>
            </div>
            <br>
            <div class="textbox">
                <p style="color: white;">CVV</p>
                <input type="number" placeholder="Código de segurança" name ="cod_cartao" value="" min="000" max="999" maxlength="3" required/>
            </div>
            <br>
            <div style="display: none;">
                <input id="codigos" type="text" name ="codigos" value=""/>
                <input id="total" type="text" name ="total" value=""/>
            </div>
            <button type="submit" id="botao_enviar" class="btn mt-3">Finalizar</button>
            <p id="mensagem" style="color: white;"></p>
        </div>
    </form>
    ';
    footer();
    ?>
    <br><br>
    
    <script type="text/javascript">
        window.onload = substituir;
        function substituir ()
        {
            codigos = document.getElementById('codigos');
            total = document.getElementById('total');
            codigos.value = localStorage.getItem('codigos');
            temp = parseFloat(localStorage.getItem('total'));
            total.value = temp.toFixed(2);
        }

        $(function(){
        $("#botao_enviar").click(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/script.php",
                data: $("#finalizar_form").serialize(),
                success: function(retorno){
                    if(retorno == 1){
                        window.location='./minhas_compras.php';
                        limpar(0);
                    }
                    else if(retorno == 0){
                        document.getElementById("mensagem").innerHTML = "Erro ao finalizar compra!";
                    }
                    else if (retorno == -1)
                    {
                        document.getElementById("mensagem").innerHTML = "Erro na conexão com BD!";
                    }
                },
                error: function(retornoErro){
                    document.getElementById("mensagem").innerHTML = "Erro no PHP!";
                }
            });
        });
    });
    </script>
</body>
</html>