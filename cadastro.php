<!--Pagina de Cadastro-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebendo os dados em formatando em String

    if (!empty($dados['CadUsuario'])){ // Quando o usuario clicar no botao
        
        $dados = array_map('trim', $dados);  // Retirar os espacos no comeco e no final dos campos (dados desnecessarios)                        
        $query_usuario = "INSERT INTO usuario(CPF, Senha, Pnome, Unome, Email) VALUES (:CPF,'" . MD5($dados['senha']) . "', :Pnome, :Unome, :Email)";
        $cad_usuario = $conexao->prepare($query_usuario); // Preparar a query para execucao
        $cad_usuario->bindParam(':CPF', $dados['cpf']);
        $cad_usuario->bindParam(':Pnome', $dados['pnome']);
        $cad_usuario->bindParam(':Unome', $dados['unome']);
        $cad_usuario->bindParam(':Email', $dados['email']);
        $cad_usuario -> execute(); // Execucao da query
                    
        if ($cad_usuario ->rowCount()){ // Se alterou a quantidade de dados que tinham no banco de dados
            $row_cad_usuario = $cad_usuario->fetch(PDO::FETCH_ASSOC);  //le os dados com o fetch
            extract($row_cad_usuario);
            $_SESSION['Pnome'] = $dados['pnome'];
            $_SESSION['Unome'] = $dados['unome'];
            $_SESSION['CPF'] = $dados['cpf'];;
            $_SESSION['Email'] = $dados['email'];
            $_SESSION['TipoAdm'] = '0';
            unset($dados);
            header(("Location: index.php")); 

        }else{  //se não cadastrou
            unset($_SESSION['Pnome']);
            unset($_SESSION['Unome']);
            unset($_SESSION['CPF']);
            unset($_SESSION['Email']);
            unset($_SESSION['TipoAdm']);
            unset($dados);
            header(("Location: login.html")); 
        }
    }

?>