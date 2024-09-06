<?php
    session_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebendo os dados em formatando em String

    if (!empty($dados['CadHotel'])){ // Quando o usuario clicar no botao
        $dados = array_map('trim', $dados);  // Retirar os espacos no comeco e no final dos campos (dados desnecessarios)
        var_dump($dados); // Printar os dados do formulario

        $sql = "INSERT INTO Hotel(CNPJ, HNome, CEP, Numero, Cidade, CafeManha, Link_Hotel) VALUES
        (:CNPJ, :Hnome, :CEP, :Numero, :Cidade, :CafeManha, :Link_Hotel)";
        $sql_query = $conexao->prepare($sql); // Preparar a query para execucao
        $sql_query->bindParam(':CNPJ', $dados['CNPJ']);
        $sql_query->bindParam(':Hnome', $dados['HNome']);
        $sql_query->bindParam(':CEP', $dados['CEP']);
        $sql_query->bindParam(':Numero', $dados['Numero']);
        $sql_query->bindParam(':Cidade', $dados['Cidade']);
        $sql_query->bindParam(':CafeManha', $dados['CafeManha']);
        $sql_query->bindParam(':Link_Hotel', $dados['Link_Hotel']);

        $sql_query -> execute(); // Execucao da query
                    
        if ($sql_query ->rowCount()){ // Se alterou a quantidade de dados que tinham no banco de dados
            unset($dados);
            header("Location: administrador.php");
        }else{ // Se nao foi possivel cadastrar o usuario
            header("Location: administrador.php");
        }
    }

?>