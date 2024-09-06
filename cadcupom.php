<?php
    session_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebendo os dados em formatando em String

    if (!empty($dados['CadCupom'])){ // Quando o usuario clicar no botao
               
        $dados = array_map('trim', $dados);  // Retirar os espacos no comeco e no final dos campos (dados desnecessarios)
        var_dump($dados); // Printar os dados do formulario

        $sql = "INSERT INTO Cupom(Codigo, Desconto) VALUES (:Codigo, :Desconto)";
                    
        $sql_query = $conexao->prepare($sql); // Preparar a query para execucao
        $sql_query->bindParam(':Codigo', $dados['codigoc']);
        $sql_query->bindParam(':Desconto', $dados['desconto']);

        $sql_query -> execute(); // Execucao da query
                    
        if ($sql_query ->rowCount()){ // Se alterou a quantidade de dados que tinham no banco de dados
            unset($dados);
            header("Location: administrador.php");
        }else{ // Se nao foi possivel cadastrar o usuario
            header("Location: administrador.php");
        }
    }

?>