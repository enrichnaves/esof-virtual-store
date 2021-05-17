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

    <title>Alterar Cadastro</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src="../lib/js/js.js"></script><!--colocar js-->
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>

<body style="background: black;">
    <!--*******************************MENU*******************************-->
    <?php
        include_once "./navbar.php";
        user_navbar();
    echo '<a class="btn btn-primary barra" style="background: none;" href="#">Alterar Cadastro</a>';
    echo '
    <form id="alter_cadas">
        <div class="box">
        <br> <br> 
        <div class="textbox">
            <input type="text" minlength="3" maxlength="16" placeholder="Username" name ="username_alt" value="'.$_SESSION['usuario'].'" oninput="mascaraUsername(this)" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="password" placeholder="Password" minlength="6" value="'.$_SESSION['senha'].'" name ="password_alt" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="Nome Completo" name ="nome_alt" value="'.$_SESSION['nome'].'" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="CPF" name ="cpf_alt" oninput="mascaraCpf(this)" minlength="14" value="'.$_SESSION['cpf'].'" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="text" placeholder="Endereço" name ="endereco_alt" value="'.$_SESSION['endereco'].'" required/>
        </div>
        <br>
        <div class="textbox">
            <input type="tel" placeholder="Telefone" name ="telefone_alt" value="'.$_SESSION['telefone'].'" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" oninput="mascaraTelefone(this)" required/>
        </div>
        <br>
        <button id="botao_enviar" class="btn mt-3">Alterar</button>
        </div>
    </form>
    <p style="color: white">Obs: Não é possível alterar o seu cpf!! Caso seja necessário entre em contato conosco.</p>
    ';
    footer();
    ?>
    <p id="mensagem" style="color: white;"></p>
</body>
<script type="text/javascript">
    $(function(){
        $("#botao_enviar").click(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/script.php",
                data: $("#alter_cadas").serialize(),
                success: function(retorno){
                    if(retorno == 1){
                        window.location='./alt_cadastro.php';
                    }
                    else if(retorno == 0){
                        document.getElementById("mensagem").innerHTML = "Erro ao alterar cadastro!";
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