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

    <title>Vendas</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/login.css">
    <script src=""></script><!--colocar js-->
    <script src="../lib/bootstrap/js/jquery-3.4.1.js"></script>
</head>
<body style="background: black;">
    <!--*******************************MENU*******************************-->
    <?php
        include_once "./navbar.php";
        include_once "../controllers/bd_connection.php";
        adm_navbar();
    
        echo '<a class="btn btn-primary barra" style="background: none;" href="#">VENDAS REALIZADAS</a>';
        echo '<table id = "listTable" class = "table" style="color: white;"></table>';
        $sql = "SELECT * from compra";
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
    ?>
    
</body>
</html>