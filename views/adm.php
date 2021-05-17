<?php
    session_start();
    if(isset ($_SESSION['usuario']) || isset ($_SESSION['admin']))
    {
        header("Location: ./index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./../lib/css/login.css">
    <script src="./../lib/bootstrap/js/jquery-3.4.1.js"></script>
    <title>Login ADM</title>
</head>

<body >
    <a class="btn btn-primary barra" href="#">ADM</a>
    <div class="container">
        <form id="login_adm">
            <div class="login-box">
                <div class="textbox">
                    <input type="text" placeholder="admin" name ="admin" value="">
                </div>
                <div class="textbox">
                    <input type="password" placeholder="password_adm" name ="password_admin"  value="">
                </div>
                
                <button id="botao_enviar" class="btn mt-3">Entrar</button>
            </div>
        </form>
        <p id="mensagem" style="color: white;"></p>
    </div>
    
</body>
<script type="text/javascript">   
        $(function(){
            $("#botao_enviar").click(function(){
                $.ajax({
                    method:"POST",
                    url:"../controllers/script.php",
                    data: $("#login_adm").serialize(),
                    success: function(retorno){
                        var retorno =  JSON.parse(retorno);
                        if(retorno['OK'] == '0')
                        {
                            window.location='./editar_produtos.php';
                        }else if(retorno['NO'] == '1')
                        {
                            document.getElementById("mensagem").innerHTML = "Usuario e senha não encontrados";
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

