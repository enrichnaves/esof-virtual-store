  <?php
        include_once "./bd_connection.php";
            
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["user_login"]) && isset($_POST["password_login"])) //LOGIN USUARIO
        {
            $login = $_POST["user_login"];
            $senha = $_POST["password_login"];
            
            if ($conexao){
                $sql="SELECT COUNT(*)
                FROM usuarios
                WHERE usuario = '$login'
                AND senha = '$senha'
                ;";
                $result= pg_fetch_row(pg_exec($conexao, $sql));
                if ($result[0] == 1)
                {
                    $_SESSION['usuario'] = $login;
                    $_SESSION['senha'] = $senha;
                    $sql="SELECT nome, cpf, endereco, telefone
                            FROM usuarios
                            WHERE usuario = '$login'
                            AND senha = '$senha'
                            ;";
                    $result= pg_fetch_row(pg_exec($conexao, $sql));
                    $_SESSION['nome'] = $result[0];
                    $_SESSION['cpf'] = $result[1];
                    $_SESSION['endereco'] = $result[2];
                    $_SESSION['telefone'] = $result[3];
                    
                    $arr = array('OK' => 0);
                    echo json_encode($arr);
                }else
                {
                    $arr = array('NO' => 1);
                    echo json_encode($arr);
                }
            }else
            {
                $arr = array('ERRO' => -1);
                    echo json_encode($arr);
            }

        }else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["username_alt"])) //ALTERAR CADASTRO
        {
            $username = $_POST["username_alt"];
            $password = $_POST["password_alt"];
            $nome = $_POST["nome_alt"];
            $endereco = $_POST["endereco_alt"];
            $telefone = $_POST["telefone_alt"];
            $login = $_SESSION['usuario'];
            $senha = $_SESSION['senha'];
            if ($conexao){
                $sql="UPDATE usuarios
                SET usuario = '$username',
                senha = '$password',
                nome = '$nome',
                endereco = '$endereco',
                telefone = '$telefone'
                WHERE usuario = '$login'
                AND senha = '$senha'
                ;";
                $result= pg_fetch_row(pg_exec($conexao, $sql));
                $_SESSION['usuario'] = $username; 
                $_SESSION['senha'] = $password;
                $_SESSION['nome'] = $_POST["nome_alt"];
                $_SESSION['endereco'] = $_POST["endereco_alt"];
                $_SESSION['telefone'] = $_POST["telefone_alt"];
                echo  "1";
            }
            else{
                echo "0";
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["num_cartao"])) //FINALIZAR COMPRA
        {
            $num_cartao = $_POST["num_cartao"];
            $cvv = $_POST["cod_cartao"];
            $val_cartao = $_POST["data_cartao"];
            $cpf = $_SESSION["cpf"];
            $id_produto = $_POST["codigos"];
            $data_compra = date('d/m/Y H:i');
            $valor_final = $_POST["total"];

            if ($conexao){
                $sql="INSERT INTO public.compra(
                id_produtos, data_compra, valor, num_cartao, cvv, val_cartao, cpf)
                VALUES ('$id_produto', '$data_compra', '$valor_final', '$num_cartao', '$cvv', '$val_cartao', '$cpf');";
                $result= pg_exec($conexao, $sql);
                if ($result)
                {
                    echo  "1";
                }else
                {
                    echo  "0";
                }
            }else
            {
                echo "-1";
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["username_cad"])) //CADASTRAR
        {
            $user = $_POST["username_cad"];
            $nome = $_POST["nome_cad"];
            $senha = $_POST["password_cad"];
            $nome = $_POST["nome_cad"];
            $cpf = $_POST["cpf_cad"];
            $endereco = $_POST["endereco_cad"];
            $telefone = $_POST["telefone_cad"];

            if ($conexao){
                $sql="INSERT INTO public.usuarios(
                    cpf, endereco, senha, telefone, nome, usuario)
                    VALUES ('$cpf', '$endereco', '$senha', '$telefone', '$nome', '$user');";
                $result=pg_exec($conexao, $sql);
                if ($result){
                    echo "1";
                }else
                {
                    echo "0";
                }
            }
            else
            {
                echo "-1";
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["admin"])) //LOGIN ADMIN
        {
            $admin = $_POST["admin"];
            $senha = $_POST["password_admin"];

            if ($conexao){
                $sql="SELECT COUNT(*)
                FROM admins
                WHERE login = '$admin'
                AND senha = '$senha'
                ;";
                $result= pg_fetch_row(pg_exec($conexao, $sql));
                if ($result[0] == 1)
                {
                    $_SESSION['admin'] = $admin;
                    $arr = array('OK' => 0);
                    echo json_encode($arr);
                }else
                {
                    $arr = array('NO' => 1);
                    echo json_encode($arr);
                }
            }else
            {
                $arr = array('ERRO' => -1);
                echo json_encode($arr);
            }

        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cod_cancel"]))
        {
            $cod_cancel = $_POST['cod_cancel'];
            if ($conexao)
            {
                
                $sql="SELECT COUNT(*)
                FROM public.compra
                WHERE id_compra = '$cod_cancel'
                ;";
                $result= pg_fetch_row(pg_exec($conexao, $sql));
                if ($result[0] == 1)
                {
                    $sql = "DELETE FROM public.compra WHERE id_compra = '$cod_cancel';";
                    $result = pg_exec($conexao, $sql);
                    if ($result){
                        echo  0;
                    }
                }else
                {
                    echo  1;
                }
            }else
            {
                echo -1;
            }
                 
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["codigo_alt"]))
        {
            $cod_alt = $_POST["codigo_alt"];
            $nome = $_POST["nome_alt"];
            $preco = $_POST["preco_alt"];
            if ($conexao){
                $sql = "SELECT COUNT(*) FROM produto WHERE id = '$cod_alt';";
                $fetch = pg_fetch_row(pg_exec($conexao, $sql));
                if ($fetch[0]==1)
                {
                    $sql="UPDATE produto
                    SET nome = '$nome',
                    preco = '$preco'
                    WHERE id = '$cod_alt'
                    ;";
                    $result= pg_exec($conexao, $sql);
                    if($result){
                        echo  "1";
                    }else
                    {
                        echo "0";
                    }
                }else
                {
                    $sql="INSERT INTO produto
                    (id, preco, nome)
                    VALUES
                    ('$cod_alt', '$preco', '$nome')
                    ;";
                    $result= pg_exec($conexao, $sql);
                    if ($result)
                    {
                        echo "1";
                    }else
                    {
                        echo "0";
                    }
                }
            }else
            {
                echo "-1";
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod_excluir']))
        {
            if($conexao)
            {
                $cod_excluir = $_POST['cod_excluir'];
                $sql = "SELECT COUNT(*) FROM produto WHERE id = '$cod_excluir';";
                $fetch = pg_fetch_row(pg_exec($conexao, $sql));
                if ($fetch[0]==1)
                {
                    $sql = "DELETE FROM produto WHERE id = '$cod_excluir';";
                    $result = pg_exec($conexao, $sql);
                    if ($result){
                        echo "1";
                    }
                }
                else
                {
                    echo  "0";
                }
            }else
            {
                echo "-1";
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            echo "veio so o request POST";
        }
        else{
            session_destroy();
            echo  "<script>window.location='../views/index.php';</script>";
        }
    ?>