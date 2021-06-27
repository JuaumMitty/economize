<?php
            
            // Soma total de receitas
            $sql_somaReceita = "SELECT SUM(valor) as 'totalReceita' FROM gastos WHERE tipo='add';";
            $resultado_receita = mysqli_query($conecta, $sql_somaReceita);
            $receita = mysqli_fetch_array($resultado_receita);
            $converteReceita = floatval($receita['totalReceita']);
            $formataReceita = number_format($converteReceita, 2, ',', '.');
    
            // Soma total de despezas
            
            $sql_somaDespeza = "SELECT SUM(valor) as 'totalDespeza' FROM gastos WHERE tipo='remove';";
            $resultado_despeza = mysqli_query($conecta, $sql_somaDespeza);
            $despeza = mysqli_fetch_array($resultado_despeza); 
            $converteDespeza = floatval($despeza['totalDespeza']);
            $formataDespeza = number_format($converteDespeza, 2, ',', '.');

            //Calcula total com formatação
            $total = number_format(($converteReceita - $converteDespeza), 2, ',', '.');
            
            // Fecha conexão com banco de dados
            $resultado_receita -> close();
            $resultado_despeza -> close();
            

?>
