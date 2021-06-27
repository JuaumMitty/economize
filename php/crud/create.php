<?php
    //Iniciar sessão
    session_start();

    // Conecta ao banco de dados
    require_once '../db_config/db_conecta.php';
    
    
    // Faz o insert das despezas no banco de dados
    if(isset($_POST['btn-despeza'])){
        $descricao = mysqli_escape_string($conecta, $_POST['descricao']);
        $valor = mysqli_escape_string($conecta, $_POST['valor']);
        $data = mysqli_escape_string($conecta, $_POST['data']);
        $categoria = mysqli_escape_string($conecta, $_POST['categoria']);
        $tipo = mysqli_escape_string($conecta, 'remove');
        
        $valor = str_replace(',','.',$valor);
        
        $sql_insert = "INSERT INTO gastos(descricao, valor, data, categoria, tipo) VALUES('$descricao','$valor','$data','$categoria','$tipo');";
    
        if(mysqli_query($conecta, $sql_insert)){
            $_SESSION['mensagem'] = "Cadastrado com sucesso!";
            header('Location: ../../dashboard.php?sucesso');
            mysqli_close($conecta);
        } else{
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header('Location: ../../dashboard.php?erro');
            mysqli_close($conecta);
        }
    }
    
    // Faz o insert das receitas no banco de dados
    
    if(isset($_POST['btn-receita'])){
        $descricao = mysqli_escape_string($conecta, $_POST['descricao']);
        $valor = mysqli_escape_string($conecta, $_POST['valor']);
        $data = mysqli_escape_string($conecta, $_POST['data']);
        $categoria = mysqli_escape_string($conecta, $_POST['categoria']);
        $tipo = mysqli_escape_string($conecta, 'add');
        
        $valor = str_replace(',','.',$valor);
        
        $sql_insert = "INSERT INTO gastos(descricao, valor, data, categoria, tipo) VALUES('$descricao','$valor','$data','$categoria','$tipo');";
    
        if(mysqli_query($conecta, $sql_insert)){
            $_SESSION['mensagem'] = "Cadastrado com sucesso!";
            header('Location: ../../dashboard.php?sucesso');
            mysqli_close($conecta);
        } else{
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header('Location: ../../dashboard.php?erro');
            mysqli_close($conecta);
        }
    }
    
    
?>


