<?php 
    //Iniciar sessão
    session_start();

    // Conecta ao banco de dados
    require_once '../db_config/db_conecta.php';
    
    if(isset($_POST['btn-atualizar'])){
        $id = mysqli_escape_string($conecta, $_POST['id']);
        $descricao = mysqli_escape_string($conecta, $_POST['descricao']);
        $valor = mysqli_escape_string($conecta, $_POST['valor']);
        $data = mysqli_escape_string($conecta, $_POST['data']);
        $categoria = mysqli_escape_string($conecta, $_POST['categoria']);
        $tipo = mysqli_escape_string($conecta, $_POST['tipo']);
        
        $sql_insert = "UPDATE gastos SET descricao='$descricao', valor='$valor', data='$data', categoria='$categoria', tipo='$tipo' WHERE id='$id';";
    
        if(mysqli_query($conecta, $sql_insert)){
            $_SESSION['mensagem'] = "Atualizado com sucesso!";
            header('Location: ../../dashboard.php?sucesso');
        } else{
            $_SESSION['mensagem'] = "Erro ao atualizar!";
            header('Location: ../../dashboard.php?erro');
        }
    } 
?>