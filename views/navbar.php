<?php 
    function user_navbar ()
    {
        echo '
        <div class="container-fluid p-0 fixed-top">
            <nav class="navbar menu navbar-expand-md">
                <a class="navbar-brand" href="Virtual-Shop/index.php"><img src="" alt=""><!--colocar logo-->
                    </button>
                    <div class="navbar-collapse collapse" id="menu">
                        <ul class="navbar-nav ">
                            <li class="nav-item" style="margin-top: -23px;">
                                <a class="nav-link" href="./index.php">
                                    <i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Home
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item cart">
                                <a class="nav-link" href="./carrinho.php">
                                    <i class="fas fa-sign-in-alt"></i> Carrinho
                                </a>
                            </li>
                        </ul>';
                        //SE O USUARIO ESTIVER LOGADO//
                        if (isset($_SESSION['usuario']))
                        {
                           $user = $_SESSION['usuario'];
                            echo 
                           '<ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="./alt_cadastro.php">
                                        <i class="fas fa-sign-in-alt"></i> Alterar Cadastro
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="./minhas_compras.php">
                                        <i class="fas fa-sign-in-alt"></i> Minhas Compras
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="../controllers/script.php">
                                        <i class="fas fa-sign-in-alt"></i>Olá '.$user.', Não é voce? Sair
                                    </a>
                                </li>
                            </ul>
                            ';
                        }else{
                        //SE NÂO ESTIVER LOGADO
                            echo 
                            '<ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="./login.php">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </a>
                                </li>
                            </ul>'
                            ;

                        }
                    echo '</div>
            </nav>
        </div>
        ';
    }



    function adm_navbar ()
    {
        echo '
            <div class="container-fluid p-0 fixed-top">
                <nav class="navbar menu navbar-expand-md">
                    <a class="navbar-brand" href="Virtual-Shop/index.php"><img src="" alt=""><!--colocar logo-->
                        </button>
                        <div class="navbar-collapse collapse" id="menu">
                            <ul class="navbar-nav ">
                                <li class="nav-item" style="margin-top: -23px;">
                                    <a class="nav-link" href="./index.php">
                                        <i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Home
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="./editar_produtos.php">
                                        <i class="fas fa-sign-in-alt"></i> Editar Produtos
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="./gerenciar_vendas.php">
                                        <i class="fas fa-sign-in-alt"></i> Gerenciar Vendas
                                    </a>
                                </li>
                            </ul><ul class="navbar-nav ml-auto">
                                <li class="nav-item cart">
                                    <a class="nav-link" href="../controllers/script.php">
                                        <i class="fas fa-sign-in-alt"></i>Olá '.$_SESSION['admin'].', Não é voce? Sair
                                    </a>
                                </li>
                            </ul>
                            </div>
                        </div>
                </nav>
            </div>
        ';
    }

    function footer()
    {
        echo '
        <br><br>  
        <section class="footer text-center" style="margin-top: 100px; color: white;">
            <div class ="blank">  
            </div>
            <div>
            <p>Direitos autorais © 2020 Virtual Store Todos os direitos reservados.</p>
                <p>virtualstore@virtualstore.com.br</p>
                <p>0800-080-0800</p>
                <p><h2>@Virtual_Store</h2></p>
                <a href="editar_produtos.php">Area administrativa</a>
            </div>
        </section>
        ';
    }
?>