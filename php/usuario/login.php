<?php
    require_once '../db_config/db_conecta.php';
    //Arquivo para verificar o acesso e realizar o inicio da sessão do usuário
    session_start(); //Inicia uma nova sessão ou resume uma sessão existente
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $senha = md5($senha);
    
    //verificação de login e senha
    $consultaLogin = "SELECT * FROM usuario WHERE id_email='$email' AND senha='$senha'";
    $resultado = $conecta-> query($consultaLogin);
    
    //Pegar o nome do usuário
    //$consultaNome = "SELECT nome FROM usuario WHERE id_email='$email'";
    //$resultado_nome = mysqli_query($conecta, $consultaNome);
    //$nome = mysqli_fetch_array($resultado_nome);
    
    if($resultado-> num_rows > 0){
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        
        
        header('location:../../dashboard.php'); //redirecionamento para a página de acesso
    } else {
        session_unset(); // Remove todas as váriáveis de sessão
        session_destroy(); // Remove todas as variáveis de sessão
        echo "<script> alert('Login ou senha incorreto');"
        . "window.location.href='../../index.html';</script>";
    }
?>
