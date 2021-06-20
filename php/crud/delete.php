<?php 
    //Iniciar sessão
    session_start();

    // Conecta ao banco de dados
    require_once '../db_config/db_conecta.php';
    
    if(isset($_POST['btn-deletar'])){
        $id = mysqli_escape_string($conecta, $_POST['id']);
       
        $sql = "DELETE FROM gastos WHERE id = '$id'";
    
        if(mysqli_query($conecta, $sql)){
            $_SESSION['mensagem'] = "Deletado com sucesso!";
            header('Location: ../../dashboard.php?sucesso');
        } else{
            $_SESSION['mensagem'] = "Erro ao deletar!";
            header('Location: ../../dashboard.php?erro');
        }
    } 
?>
