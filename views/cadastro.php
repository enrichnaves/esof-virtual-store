<?php
    session_start();
    if(isset ($_SESSION['usuario']) || isset ($_SESSION['admin']))
    {
        header("Location: ./index.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cadastro</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src="../lib/js/js.js"></script><!--colocar js-->
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black;">
        <?php
        include_once "./navbar.php";
        user_navbar();
        ?>

    <a class="btn btn-primary barra" style="background: none;" href="#">Cadastro</a>
    <form id="realizar_cadas">
    <div class="box">
        <br> <br> 
        <div class="textbox">
            <input type="text" minlength="3" maxlength="16" placeholder="Username" name ="username_cad" oninput="mascaraUsername(this)" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="password" placeholder="Password" minlength="6" name ="password_cad" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="Nome Completo" name ="nome_cad" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="CPF" name ="cpf_cad" oninput="mascaraCpf(this)" minlength="14" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="Endereço" name ="endereco_cad"  required/>
        </div>
        <br>
        <div class="textbox">
            <input type="tel" placeholder="Telefone" name ="telefone_cad"  pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" oninput="mascaraTelefone(this)" required/>
        </div>
        <br>
        <button type="button" id = "botao_enviar" class="btn mt-3">Cadastrar</button>
    </div>
    </form>
    <p id="mensagem" style="color: white;"></p>
</body>
<script type="text/javascript">
    $(function(){
        $("#botao_enviar").click(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/script.php",
                data: $("#realizar_cadas").serialize(),
                success: function(retorno){
                    if(retorno == 1){
                        window.location='./login.php';
                    }
                    else if(retorno == 0){
                        document.getElementById("mensagem").innerHTML = "Erro ao realizar cadastro!";
                    }else if(retorno == -1){
                        document.getElementById("mensagem").innerHTML = "Erro na conexão com o BD!";
                    }
                },
                error: function(retornoErro){
                    document.getElementById("mensagem").innerHTML = "Deu erro!";
                }
            });
        });
    });
</script>
</html>