<?php
    //Dados de acesso ao banco de dados
    
    $local = "localhost";
    $usuarioDB = "root";
    $senhaDB = "";
    $db_nome = "economize_database";
    
    
    //conexão com o banco de dados
    $conecta = new mysqli($local, $usuarioDB, $senhaDB, $db_nome);
    mysqli_set_charset($conecta, "utf8");
    
    if($conecta -> connect_error === TRUE) {
        die("Erro na conexão: ".$conecta -> connect_error);
    }
    
   ?>
