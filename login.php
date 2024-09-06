<!--Pagina de Login-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebendo os dados e formatando em String

    if (!empty($dados['LogUsuario'])){ // Quando o usuario clicar no botao
               
        $dados = array_map('trim', $dados);  // Retirar os espacos no comeco e no final dos campos (dados desnecessarios)                       
        $query_usuario = "SELECT Pnome, Unome, CPF, TipoAdm FROM usuario WHERE Email = :Email AND Senha = '" . MD5($dados['senha']) . "'"; //cria a query
        $log_usuario = $conexao->prepare($query_usuario); // Prepara a query para execucao
        $log_usuario->bindParam(':Email', $dados['email']);
        $log_usuario -> execute(); // Execucao da query
                 
        if(($log_usuario->rowCount() != 0)){  //se tiver achado usuario
            $row_log_usuario = $log_usuario->fetch(PDO::FETCH_ASSOC);  //le os dados com o fetch
            extract($row_log_usuario);
            $_SESSION['Pnome'] = $Pnome;
            $_SESSION['Unome'] = $Unome;
            $_SESSION['CPF'] = $CPF;
            $_SESSION['TipoAdm'] = $TipoAdm;
            $_SESSION['Email'] = $dados['email'];
            unset($dados);

            if($_SESSION['TipoAdm']){ //se for administrador
                header("Location: administrador.php");
            }else{ //se for usuario
                header("Location: index.php");
            }       
                 
        }else {   //se não tiver achado o usuario
            unset($_SESSION['Pnome']);
            unset($_SESSION['Unome']);
            unset($_SESSION['CPF']);
            unset($_SESSION['TipoAdm']);
            unset($_SESSION['Email']);
            unset($dados);
            header('Location: login.html');
        }
    }
?>