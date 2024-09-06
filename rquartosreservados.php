<?php
    session_start();
    include_once 'conexao.php';
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/Logoo.png">  <!--icone da aba do navegador-->
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>
    <title>Administrador</title> <!-- titulo no navegador -->
</head>
<body>
    <header> <!--menu superior-->
        <div class="boxmenuad">
            <div class="logo">
                <img src="img/Logotipo.png">
            </div>
            <div class="menu">
                <p id="titulo">ADMINISTRADOR</p>
            </div>
            <div class="login">
                <?php if(($_SESSION['TipoAdm']) == '0'){ 
                        header("Location: doLogout.php");
                } ?>
                <a href="login.html"><img id="iconlogin" src="img/iconlogin.png"></a>
                <div class="flogin"><b>Seja bem-vindo,<b>
                    <b><?php echo ($_SESSION['Pnome']); ?></b>
                    <br><a href="doLogout.php"><b>Sair<b></a>
                </div>
            </div>
        </div>
    </header>
    
    <?php    
    $query_sql = "SELECT Htl.Hnome as Nome_Hotel, Rsv.CNPJ as CNPJ_Hotel, Rsv.NumQuarto as Numero_Quarto, Rsv.Entrada as Data_Check_In, Rsv.Saida as Data_Check_Out
    From Reserva as Rsv JOIN Hotel as Htl On Rsv.CNPJ = Htl.CNPJ
    WHERE Rsv.Estado = 'Reservado';"; //cria a query
    $sql = $conexao->prepare($query_sql); // Prepara a query para execucao
    $sql -> execute(); // Execucao da query

    if($sql->rowCount() != 0){  //se tiver achado alguma reserva para contar
        ?>
        <center>
        <div>
            <center><h1>Relatório Quartos Reservados</h1></center>
            <table border="1" align="center">
            <tr>
                <td>Nome_Hotel</td>
                <td>CNPJ_Hotel</td>
                <td>Numero_Quarto</td>
                <td>Data_Check_In</td>
                <td>Data_Check_Out</td>
            </tr>
        <?php
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            extract($row) //feth_assoc para poder imprimir atraves do nome da coluna ?>
            <tr>
                <td><center><?php echo $row["Nome_Hotel"]; ?></center></td>
                <td><center><?php echo $row["CNPJ_Hotel"]; ?></td>
                <td><center><?php echo $row["Numero_Quarto"]; ?></center></td>
                <td><center><?php echo $row["Data_Check_In"]; ?></center></td>
                <td><center><?php echo $row["Data_Check_Out"]; ?></center></td>
            </tr>
            
        <?php } ?>
        </div>
        </center>
        
        <div>
            <center><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Voltar</a></center>
        </div>
        
        <?php
    }else{
        echo "<p style='color: #ff0000;'>Não há reservas no banco de dados...</p>";
        echo $_SESSION['CPF'];
    }

    ?>
</body>
</html>
