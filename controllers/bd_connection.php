<?php
     if (!isset($_SESSION))
     {
         session_start();
     }
     
     $servidor = "virtualshop.postgres.uhserver.com";
     $porta = 5432;
     $bancoDeDados = "virtualshop";
     $usuario = "trabalho";
     $senha = "Error404@!";

     $conexao = pg_connect("host=$servidor port=$porta dbname=$bancoDeDados user=$usuario password=$senha");
     if(!$conexao) {
         die("Não foi possível se conectar ao banco de dados.");
     }else
     {
         //echo "Connected";
     }
?>
