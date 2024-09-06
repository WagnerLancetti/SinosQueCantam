<!--Pagina logout-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez  
    unset($_SESSION['Pnome']);
    unset($_SESSION['Unome']);
    unset($_SESSION['CPF']);
    unset($_SESSION['TipoAdm']);
    unset($_SESSION['Email']);
    header("Location: index.php");
?>