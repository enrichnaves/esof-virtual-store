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

    <title>Home</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black; padding-top: 60px;">
    <!--*******************************MENU*******************************-->
    <?php
        include_once "./navbar.php";
        include_once "../controllers/bd_connection.php";
        user_navbar();
        echo '<table id = "listTable" class = "table" style="color: white;"></table>';
        $cpf = $_SESSION['cpf'];
        $sql = "SELECT * from compra where cpf = '$cpf';";
        $fetch = pg_exec($conexao, $sql);
        $table = "<thead><tr><td>ID Compra</td><td>ID Produtos</td><td>Data</td><td>Valor</td><td>Cartao</td><td>CVV</td><td>Val</td><td>CPF</td></tr></thead><tbody>";
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
        echo '
        <a class="btn btn-primary barra" style="background: none;" href="#">Cancelar compras: </a>
        
        <form id="cancelForm">
            <div class="textbox">
                <input style="color: white;" type="number" placeholder="Digite o código da compra" name ="cod_cancel"  value="" required/>
                    
            </div>
                <button id="botaoCancela" type="button" class="btn mt-3">Cancelar compra</button>
        </form>
        <p id="mensagem" style="color: white;"></p>
        ';
        footer();
    ?>
    
</body>
<script type="text/javascript">   
        $(function(){
            $("#botaoCancela").click(function(){
                $.ajax({
                    method:"POST",
                    url:"../controllers/script.php",
                    data: $("#cancelForm").serialize(),
                    success: function(retorno){
                        if (retorno == 0)
                        {
                            location.reload();
                        }else if (retorno == 1)
                        {
                            document.getElementById("mensagem").innerHTML = "Compra não encontrada";
                        }else if (retorno == -1)
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
