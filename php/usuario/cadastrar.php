<?php
    //Iniciar sessão
    session_start();

    // Conecta ao banco de dados
    require_once '../db_config/db_conecta.php';
    
    if(isset($_POST['btn-cadastrar'])){
        $email = mysqli_escape_string($conecta, $_POST['email']);
        $nome = mysqli_escape_string($conecta, $_POST['nome']);
        $sobrenome = mysqli_escape_string($conecta, $_POST['sobrenome']);
        $senha = mysqli_escape_string($conecta, $_POST['senha']);
        $confirmaSenha = mysqli_escape_string($conecta, $_POST['confirma_senha']);
        
        if($senha == $confirmaSenha) {
            $sql_cadastrar = "INSERT INTO usuario(id_email, nome, sobrenome, senha) VALUES('$email','$nome','$sobrenome',md5('$senha'));";
            if(mysqli_query($conecta, $sql_cadastrar)){
                $_SESSION['mensagem'] = "Cadastrado com sucesso!";
                header('Location: ../../index.html?sucesso');
            } else{
                $_SESSION['mensagem'] = "Erro ao cadastrar!";
                header('Location: ../../index.html?erro');
            }
        }        
    }      
?>


