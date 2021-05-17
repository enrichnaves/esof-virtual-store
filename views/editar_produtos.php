<?php
    session_start();
    if(!(isset($_SESSION['admin'])))
    {
        header("Location: ./adm.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Edite Produtos</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/index.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black; padding-top: 50px;">
    
    <?php
        include_once "./navbar.php";
        adm_navbar();
        include_once "../controllers/bd_connection.php";
        echo '<table id = "listTable" class = "table" style="color: white;"></table>';
        $sql = "SELECT * from produto;";
        $fetch = pg_exec($conexao, $sql);
        $table = "<thead><tr><td>ID Produto</td><td>Nome</td><td>Preço</td></tr></thead><tbody>";
        while ($row = pg_fetch_row($fetch))
        {
            $table = $table . "<tr>";
            foreach ($row as $value){
                
            $table = $table .'<td>'. $value . '</td>';
            }
            $table = $table . "</tr>";
            
        }
        $table = $table . "</body>";
        echo '
        <script>
            window.onload=fazerTabela;
            function fazerTabela()
            {
                document.getElementById("listTable").innerHTML += "' . $table .'";
            }
        </script>';
    ?>
    
    <form id="editar_prod">
        <div class="box">
            <div class="textbox">
                <a class="btn btn-primary barra" style="background: none;" >Digite um id de produto para alterar ou cadastrar:</a>
                <input type="number" placeholder="Para cadastrar um novo produto insira um id inexistente" name ="codigo_alt" required/>
            </div>
                <a class="btn btn-primary barra" style="background: none;" >Dados para alterar:</a>
            <div class="textbox">
                <input type="text" placeholder="Nome" name ="nome_alt" required/>
            </div>
            <div class="textbox">
                <input type="number" placeholder="Preço" name ="preco_alt"  step="any" required/>
            </div>
            <button  id="botao_enviar1" class="btn mt-3">Confirmar</button>
        </div>

    </form>
    <form id = "excluir_prod">
        <div class="box">
            <a class="btn btn-primary barra" style="background: none;">Digite um codigo de produto para excluir:</a>
            <div class="textbox">
                <input type="number" placeholder="Digite o código aqui" name ="cod_excluir" required/>
            </div>
            <button id="botao_enviar2" class="btn mt-3">Excluir</button>
        </div>
    </form>
    <p id="mensagem" style="color: white;"></p>
</body>
<script type="text/javascript">
    $(function(){
        $("#botao_enviar1").click(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/script.php",
                data: $("#editar_prod").serialize(),
                success: function(retorno){
                    if(retorno == "1"){
                        document.getElementById("mensagem").innerHTML = "Cadastro ou edição realizada com sucesso!";
                        sleep(2);
                        window.location='./editar_produtos.php';
                    }
                    else if(retorno == "0"){
                        document.getElementById("mensagem").innerHTML = "Erro ao realizar cadastro ou edição!";
                        sleep(2);
                        window.location='./editar_produtos.php';
                    }
                },
                error: function(retornoErro){
                    document.getElementById("mensagem").innerHTML = "Deu erro!";
                }
            });
        });
        $("#botao_enviar2").click(function(){
            $.ajax({
                method: "POST",
                url: "../controllers/script.php",
                data: $("#excluir_prod").serialize(),
                success: function(retorno){
                    if(retorno == 1){
                        window.location='./editar_produtos.php';
                    }
                    else if(retorno == 0){
                        document.getElementById("mensagem").innerHTML = "Produto não encontrado!";
                    }else if(retorno == -1){
                        document.getElementById("mensagem").innerHTML = "Problema na conexão com BD!";
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