<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Icone cabeçalho -->
        <link rel="icon" type="image/png" href="img/economize-icon.png"/>
        <title>Economize | Dashboard</title>
        <!-- Fonts: Font Awesome, Material Icon e Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <!-- Bootstrap v5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        
        <!-- CSS modular -->
        <link rel="stylesheet" type="text/css" href="css/geral/root.css">
        <link rel="stylesheet" type="text/css" href="css/geral/menu.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/gastos.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/botoes.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/saldo.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/distribuicao.css">
        <link rel="stylesheet" type="text/css" href="css/geral/rodape.css">

        <!-- CSS MODAIS -->
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/atualiza.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/despeza.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/receita.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard/tabela_gastos/deletar.css">

    </head>
    <body>
        <?php
            //Conexão com banco de dados
            include_once 'php/db_config/db_conecta.php';
            include_once 'php/actions/calculaTotal.php';
            //include_once 'php/usuario/login.php';
            // Sessão
            //session_start();
            //if(isset($_SESSION['menssagem'])){
            //    echo $_SESSION['mensagem'];
            //}
            //session_unset();
        ?>
        <nav class="menu">
            <div class="menu__content">
                <a href="index.html"><img src="img/economize-logo.png"></a>
            </div>
            <div class="menu__content">
                <ul class="menu__items">
                    <li class="menu__items__lista"><a class="menu__items--texto"  href="sobre">Olá, usuário!</a></li>
                    <div class="menu__items--separador"></div>
                    <li class="menu__items__lista"><a class="menu__items--texto" href="php/usuario/logout.php">Sair</a></li>
                </ul>
            </div>
        </nav>
        <main class="tela-dashboard" class="container">
        
            <div class="row justify-content-between align-items-top">
                <div class="col-md-7 dashboard__container">
                    <section class="gastos row justify-content-center align-items-center dashboard__card">
                            
                        <h1 class="dashboard__titulo">Gastos mensais</h1>
                        <div class="gastos__teste">
                            <hr>
                            <?php 
                                $select = "SELECT * FROM gastos;";
                                $resultado_select = mysqli_query($conecta, $select);
                                
                                while($dados = mysqli_fetch_array($resultado_select)){
                            ?>
                            <table class="gastos__tabela">
                                <tr>
                                    <th class="gastos__tabela__titulo"><?php echo $dados['descricao']; ?></th>
                                    <th class="dashboard--icons gastos__tabela__icones">
                                        <a class="dashboard--icons--amarelo" data-bs-toggle="modal" data-bs-target="#modalAtualizar<?php echo $dados['id']; ?>" href="#modalAtualizar<?php echo $dados['id']; ?>" >edit</a> 
                                    
                                        <a class="dashboard--icons--vermelho" data-bs-toggle="modal" data-bs-target="#modalDeletar<?php echo $dados['id']; ?>" href="#modalDeletar<?php echo $dados['id']; ?>">delete</a>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="gastos__tabela__data"><?php echo $dados['data']; ?></td>
                                    <td class="gastos__tabela__valor"><b class="dashboard--icons"><?php echo $dados['tipo']; ?></b> R$ <?php echo number_format($dados['valor'], 2, ',', '.') ?></td>
                                </tr>
                            </table>
                            <hr>

                            <!-- Modal item -->

                            <!-- Modal atualizar -->
                            <div class="modal fade" id="modalAtualizar<?php echo $dados['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="col-md-12 atualiza__card atualiza__gastos">
                                            <form class="atualiza__form" action="php/crud/update.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                                <input type="hidden" name="tipo" value="<?php echo $dados['tipo']; ?>">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col atualiza__form__descricao atualiza__container">
                                                        <input class="atualiza__form__input" name="descricao" type="text" placeholder="Descrição do pagamento" value="<?php echo $dados['descricao']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between align-items-end">
                                                    <div class="col-md-6 atualiza__form__data atualiza__container">
                                                        <label for="data">Data:</label>
                                                        <input class="atualiza__form__input" name="data" type="date" value="<?php echo $dados['data']; ?>">
                                                    </div>
                                                    <div class="col-md-5 atualiza__form__categoria atualiza__container">
                                                        <select class="atualiza__form__input" name="categoria">
                                                            <option>Categoria</option>
                                                            <option value="Contas fixas">Contas Fixas</option>
                                                            <option value="Alimentação">Alimentação</option>
                                                            <option value="Lazer">Lazer</option>
                                                            <option value="Salário">Salário</option>
                                                            <option value="Outros">Outros</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between align-items-center atualiza__form__valor">
                                                    <div class="col-md-12 atualiza__container">
                                                        <label>Valor:</label>
                                                        <input class="atualiza__form__input" type="text" name="valor" value="<?php echo $dados['valor']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col atualiza__form__botao">
                                                        <button class="atualiza__form__botao--vermelho" data-bs-dismiss="modal" type="button">Cancelar</button>
                                                    </div>
                                                    <div class="col atualiza__form__botao">
                                                        <input class="atualiza__form__botao--azul" type="submit" value="Salvar" name="btn-atualizar">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Deletar -->
                            <div class="modal fade" id="modalDeletar<?php echo $dados['id'];?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="col-md-12 atualiza__card deletar">
                                            <form class="deletar__form" action="php/crud/delete.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                            <div class="row justify-content-center align-items-center">
                                                <h1 class="deletar__titulo">Tem certeza?</h1>
                                            </div>
                                            <div class="row justify-content-center align-items-center">
                                                <p class="deletar__texto">Você está prestes a deletar este item.</p>
                                            </div>
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col atualiza__form__botao">
                                                        <button class="atualiza__form__botao--vermelho" data-bs-dismiss="modal" type="button">Cancelar</button>
                                                    </div>
                                                    <div class="col atualiza__form__botao">
                                                        <input class="atualiza__form__botao--azul" type="submit" value="Continuar" name="btn-deletar">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal item -->


                            <?php 
                                }
                            ?>
                            
                        </div>
                        
                    </section>
                    <section class="row justify-content-center align-items-center botoes">
                        <div class="col-md-6">
                            <button class="botoes__azul botoes__container" type="button" name="btn-receita" data-bs-toggle="modal" data-bs-target="#modalReceita">Nova receita</button>
                        </div>
                        <div class="col-md-6">
                            <button class="botoes__vermelho botoes__container" type="button" name="btn-despeza" data-bs-toggle="modal" data-bs-target="#modalDespeza">Nova despeza</button>
                        </div>
                    </section>
                </div>
                <div class="col-md-5 dashboard__container">
                    <section class="row justify-content-center align-items-center dashboard__card saldo">
                        <h1 class="dashboard__titulo">Saldo total</h1>
                        <hr>
                        <table class="saldo__tabela">
                            <tr class="saldo__tabela__linha">
                                <th class="saldo__tabela__titulo">Entradas</th>
                                <td class="saldo__tabela__valor">R$ <?php echo $formataReceita; ?></td>
                            </tr>
                            <tr class="saldo__tabela__linha">
                                <th class="saldo__tabela__titulo">Saídas</th>
                                <td class="saldo__tabela__valor">R$ <?php echo $formataDespeza; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table class="saldo__tabela">
                            <tr class="saldo__tabela__linha">
                                <th class="saldo__tabela__titulo--total">Total</th>
                                <td class="saldo__tabela__valor--total">R$ <?php echo $total; ?></td>
                            </tr>
                        </table>
                    </section>
                    <section class="row justify-content-center align-items-center dashboard__card distribuicao">
                        <h1 class="dashboard__titulo">Distribuição de renda mensal</h1>
                        <hr>
                        <p>Gráfico que não sei como fazer ;-;</p>
                    </section>
                </div>
            </div>  
        </main>
        <footer class="rodape">
            <div>
                <p class="rodape__texto"><b class="rodape__texto--copyright">copyright</b> Todos os direitos reservados | 2021</p>
            </div>
            <div>
                <a href="https://github.com/JuaumMitty"><i class="fab fa-github-square rodape__icons"></i></a>
                <a href="https://www.linkedin.com/in/juaummitty/"><i class="fab fa-linkedin rodape__icons"></i></a>    
            </div>
        </footer>
        <!-- Modais -->

        <!-- Modal Despeza -->
        <div class="modal fade" id="modalDespeza" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <section class="col-md-12 atualiza__card despeza">
                        <form class="atualiza__form" action="php/crud/create.php" method="POST">
                            <div class="row justify-content-center align-items-center">
                                <div class="col atualiza__form__descricao atualiza__container">
                                    <input class="atualiza__form__input" name="descricao" type="text" placeholder="Descrição do pagamento">
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-end">
                                <div class="col-md-6 atualiza__form__data atualiza__container">
                                    <label for="data">Data:</label>
                                    <input class="atualiza__form__input" name="data" type="date">
                                </div>
                                <div class="col-md-5 atualiza__form__categoria atualiza__container">
                                    <select class="atualiza__form__input" name="categoria" value="Categoria">
                                        <option>Categoria</option>
                                        <option value="Contas fixas">Contas Fixas</option>
                                        <option value="Alimentação">Alimentação</option>
                                        <option value="Lazer">Lazer</option>
                                        <option value="Salário">Salário</option>
                                        <option value="Outros">Outros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center atualiza__form__valor">
                                <div class="col-md-12 atualiza__container">
                                    <label>Valor:</label>
                                    <input class="atualiza__form__input" type="text" name="valor">
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col atualiza__form__botao">
                                    <button class="atualiza__form__botao--vermelho" type="button" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                <div class="col atualiza__form__botao">
                                    <input class="atualiza__form__botao--azul" type="submit" value="Salvar" name="btn-despeza">
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <!-- Modal Receita -->
        <div class="modal fade" id="modalReceita" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="col-md-12 atualiza__card receita">
                        <form class="atualiza__form" action="php/crud/create.php" method="POST">
                            <div class="row justify-content-center align-items-center">
                                <div class="col atualiza__form__descricao atualiza__container">
                                    <input class="atualiza__form__input" name="descricao" type="text" placeholder="Descrição do pagamento">
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-end">
                                <div class="col-md-6 atualiza__form__data atualiza__container">
                                    <label for="data">Data:</label>
                                    <input class="atualiza__form__input" name="data" type="date">
                                </div>
                                <div class="col-md-5 atualiza__form__categoria atualiza__container">
                                    <select class="atualiza__form__input" name="categoria" value="Categoria">
                                        <option>Categoria</option>
                                        <option value="Contas fixas">Contas Fixas</option>
                                        <option value="Alimentação">Alimentação</option>
                                        <option value="Lazer">Lazer</option>
                                        <option value="Salário">Salário</option>
                                        <option value="Outros">Outros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center atualiza__form__valor">
                                <div class="col-md-12 atualiza__container">
                                    <label>Valor:</label>
                                    <input class="atualiza__form__input" type="text" name="valor">
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col atualiza__form__botao">
                                    <button class="atualiza__form__botao--vermelho" data-bs-dismiss="modal" type="button">Cancelar</button>
                                </div>
                                <div class="col atualiza__form__botao">
                                    <input class="atualiza__form__botao--azul" type="submit" value="Salvar" name="btn-receita">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        
        <!-- Modais -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="scripts/script.js"></script>
        <script type="text/javascript" src="scripts/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>