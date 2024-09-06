<!--Pagina dos quartos de um determinado hotel-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez
    $realizar_reserva = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Recebendo os dados em formatando em String

    if (!empty($realizar_reserva['renviar'])){ // Quando o usuario clicar no botao
               
        $realizar_reserva = array_map('trim', $realizar_reserva);  // Retirar os espacos no comeco e no final dos campos (dados desnecessarios)

        if ($realizar_reserva['cupom'] == ""){
            $query_reservar = "INSERT INTO reserva (estado, Entrada, Saida, QtdHospedes, CPF, NumQuarto, CNPJ) 
            VALUES ('Reservado', :Entrada, :Saida, :QtdHospedes, :CPF, :NumQuarto, :CNPJ)";
                 
            $reservar = $conexao->prepare($query_reservar); // Preparar a query para execucao
            $reservar->bindParam(':Entrada', $realizar_reserva['rentrada']);
            $reservar->bindParam(':Saida', $realizar_reserva['rsaida']);
            $reservar->bindParam(':QtdHospedes', $realizar_reserva['rhospedes']);
            $reservar->bindParam(':CPF', $_SESSION['CPF']);
            $reservar->bindParam(':NumQuarto', $realizar_reserva['rquartos']);
            $reservar->bindParam(':CNPJ', $_SESSION['CNPJ']);
            $reservar-> execute(); // Execucao da query

        }else {
            $query_reservar = "INSERT INTO reserva (estado, Entrada, Saida, QtdHospedes, CPF, NumQuarto, CNPJ, CodigoCupom) 
            VALUES ('Reservado', :Entrada, :Saida, :QtdHospedes, :CPF, :NumQuarto, :CNPJ, :CodigoCupom)";
                 
            $reservar = $conexao->prepare($query_reservar); // Preparar a query para execucao
            //$reservar->bindParam(':Estado', Hospedado);
            $reservar->bindParam(':Entrada', $realizar_reserva['rentrada']);
            $reservar->bindParam(':Saida', $realizar_reserva['rsaida']);
            $reservar->bindParam(':QtdHospedes', $realizar_reserva['rhospedes']);
            $reservar->bindParam(':CPF', $_SESSION['CPF']);
            $reservar->bindParam(':NumQuarto', $realizar_reserva['rquartos']);
            $reservar->bindParam(':CNPJ', $_SESSION['CNPJ']);
            $reservar->bindParam(':CodigoCupom', $realizar_reserva['cupom']);
            
            $reservar-> execute(); // Execucao da query
        }                   
                    
        if ($reservar->rowCount()){ // Se alterou a quantidade de dados que tinham no banco de dados
            unset($reservar);
            header(("Location: index.php"));
        }else{ 
            unset($reservar);
            echo "<p style = 'color: #ff0000;'>Reserva nao cadastrada! Datas ou quartos inválidos!</p><br>";?>
            <div>
                <br><center><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Voltar</a></center><br>
            </div>
        <?php
        }
    }

?>
