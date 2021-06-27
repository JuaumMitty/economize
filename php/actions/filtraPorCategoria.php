<?php
    
    // Seleciona os valores do BD
    $sql_contas_fixas = "SELECT sum(valor) as 'Contas Fixas'  FROM gastos WHERE categoria='Contas fixas';";
    $sql_alimentacao = "SELECT sum(valor) as 'Alimentacao'  FROM gastos WHERE categoria='Alimentação';";
    $sql_lazer = "SELECT sum(valor) as 'Lazer'  FROM gastos WHERE categoria='Lazer';";
    $sql_outros = "SELECT sum(valor) as 'Outros'  FROM gastos WHERE categoria='Outros';";
    $sql_cartao = "SELECT sum(valor) as 'Cartao'  FROM gastos WHERE categoria='Cartão de Crédito';";
    
    // Faz conexão com o banco de dados
    $resultado_contas_fixas = mysqli_query($conecta, $sql_contas_fixas);
    $resultado_alimentacao = mysqli_query($conecta, $sql_alimentacao);
    $resultado_lazer = mysqli_query($conecta, $sql_lazer);
    $resultado_outros = mysqli_query($conecta, $sql_outros);
    $resultado_cartao = mysqli_query($conecta, $sql_cartao);
    
    // Seleciona os valores
    $contas_fixas = mysqli_fetch_array($resultado_contas_fixas);
    $alimentacao = mysqli_fetch_array($resultado_alimentacao);
    $lazer = mysqli_fetch_array($resultado_lazer);
    $outros = mysqli_fetch_array($resultado_outros);
    $cartao = mysqli_fetch_array($resultado_cartao);
    
    $contas_fixas['Contas Fixas'];
    $alimentacao['Alimentacao'];
    $lazer['Lazer'];
    $outros['Outros'];
    $cartao['Cartao'];
    
    // Fecha conexão com banco de dados
    $resultado_contas_fixas -> close();
    $resultado_alimentacao -> close();
    $resultado_lazer -> close();
    $resultado_outros -> close();
    $resultado_cartao -> close();
    
    
    


?>


