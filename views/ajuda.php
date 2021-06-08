<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./../lib/css/login.css">
    <script src="./../lib/bootstrap/js/jquery-3.4.1.js"></script>
    <title>Suporte ao Usuario</title>
</head>

<body >

    <a class="btn btn-primary barra" style="background: none;" href="#">Envie sua duvida!</a>
    <?php
        include_once "./navbar.php";
    ?>
    <div class="container">
        <div class="nomeLoja" >
                <img src="">
        </div>
        <form id = "duvida_form">
            <div class="duvida-box">
                <div class="textbox">
                    <input type="text" placeholder="digite se email aqui" name ="email"  value="" required/>
                </div>
                <div class="textbox">
                    <input type="texto" placeholder="Digite sua duvida aqui" name ="duvida" value="" required/>
                </div>

                <button type="button" id="botao_enviar" class="btn mt-3">Enviar</button>

                <a href="cadastro.php"> <input class="btn btn_cadastro" >Sua duvida será respondida no email cadastrado acima!</a>
            </div>
        </form>
        <p id="mensagem" style="color: white;"></p>
    </div>
    <?php
            footer();
    ?>

</body>
<script type="text/javascript">   
        $(function(){
            $("#botao_enviar").click(function(){
                $.ajax({
                    method:"POST",
                    url:"../controllers/script.php",
                    data: $("#duvida_form").serialize(),
                    success: function(retorno){
                        var retorno =  JSON.parse(retorno);
                        if(retorno['OK'] == '0')
                        {
                            document.getElementById("mensagem").innerHTML = "Sua duvida foi enviada!";
                        }else if(retorno['NO'] == '1')
                        {
                            document.getElementById("mensagem").innerHTML = "Erro no envio da dúvida!";
                        }else if(retorno['ERRO'] == '-1')
                        {
                            document.getElementById("mensagem").innerHTML = "Problema na conexão com o BD";
                        }
                    },
                    error: function(retornoErro){
                        document.getElementById("mensagem").innerHTML = "Erro no PHP";
                    }
                });
            });
        });
</script>
</html>

