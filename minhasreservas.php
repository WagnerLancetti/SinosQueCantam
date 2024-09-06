<?php
    session_start();
    ob_start();
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
    <title> Minhas Reservas </title> <!-- titulo no navegador -->
</head>

<body>

    <header> <!--menu superior-->
        <div class="barrasuperior">
            <div class="iconprivacidade"><img src="img/privacidade.png" width="25px" height="25px"></div>
            <div class="politicaprivacidade"><a href="politicadeprivacidade.html">Política de Privacidade</a></div>
            <div class="toptelefone">(32) 3333-2222</div>
            <div class="icontelefone"><img src="img/icontel.png" width="25px" height="25px"></div>
            
        </div>
        <div class="boxmenu"> 
            <div class="logo">
                <img src="img/Logotipo.png">
            </div>
            <div class="menu">
                <ul>     
                    <li><a href="index.php">HOME</a></li> <!--link para pagina inicial-->
                    <?php
                    if(isset ($_SESSION['Email']) == true) { ?> <!--se tiver um usuario logado-->
                        <li><a href="minhasreservas.php">MINHAS RESERVAS</a></li> <!--link para pagina de contato-->
                    <?php } ?>
                    <li><a href="fale_conosco.php">FALE CONOSCO</a></li> <!--link para pagina de contato-->
                </ul>
            </div>
            <div class="login"> <!-- icone de login-->
                <?php                
                if((isset ($_SESSION['Email']) == true)) {  //-- se tiver um usuario logao
                    if(($_SESSION['TipoAdm']) == '1'){ 
                        header("Location: doLogout.php");
                    }?>
                        <img id="iconlogin" src="img/iconlogin.png">
                        <div class="flogin">Seja bem-vindo!<br>
                        <b><?php echo "$_SESSION[Pnome] $_SESSION[Unome]";?></b>
                        <br><a href="doLogout.php"><b>Sair<b></a></div>  
                                   
                <?php             
                }else {?> <!--se não tiver nenhum usuario logado -->
                    <a href="login.html"><img id="iconlogin" src="img/iconlogin.png"></a>
                    <div class="flogin">Faça <a href="login.html">login</a> para<br>  <!--link para pagina de login-->
                        <b>RESERVAR!</b></div> 
                <?php } ?>
            </div>
        </div>
    </header>
    
    <?php
    $query_reservas = "SELECT * FROM Reserva WHERE CPF = :CPF"; //cria a query
    $reservas_user = $conexao->prepare($query_reservas); // Prepara a query para execucao
    $reservas_user -> bindParam(':CPF', $_SESSION['CPF']);
    $reservas_user -> execute(); // Execucao da query

    if($reservas_user->rowCount() != 0){  //se tiver achado usuario
        ?>
        <center>
        <div>
            <br><br><center><h1>Tabela Reservas <?php echo $_SESSION['Pnome']; ?></h1></center>
            <table border="1" align="center">
            <tr>
                <td>NumReserva</td>
                <td>estado</td>
                <td>Entrada</td>
                <td>Saída</td>
                <td>QtdHospedes</td>
                <td>CPF</td>
                <td>NumQuarto</td>
                <td>CNPJ</td>
                <td>Custo_Total</td>
                <td>Código_Cupom</td>
            </tr>
        <?php
        while($row = $reservas_user->fetch(PDO::FETCH_ASSOC)) {
            extract($row) //feth_assoc para poder imprimir atraves do nome da coluna ?>
            <tr>
                <td><center><?php echo $row["NumReserva"]; ?></center></td>
                <td><center><?php echo $row["estado"]; ?></center></td>
                <td><center><?php echo $row["Entrada"]; ?></center></td>
                <td><center><?php echo $row["Saida"]; ?></center></td>
                <td><center><?php echo $row["QtdHospedes"]; ?></center></td>
                <td><center><?php echo $row["CPF"]; ?></center></td>
                <td><center><?php echo $row["NumQuarto"]; ?></center></td>
                <td><center><?php echo $row["CNPJ"]; ?></center></td>
                <td><center><?php echo $row["Custo_Total"]; ?></center></td>
                <td><center><?php echo $row["CodigoCupom"]; ?></center></td>
            </tr>
            
        <?php } ?>
        </div>
        </center>
        
        <div>
            <br><center><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Voltar</a></center><br>
        </div>
        
        <?php
    }else{
        echo "<p style='color: #ff0000;'>Você não possui reservas!!</p>";
        
    }

?>
