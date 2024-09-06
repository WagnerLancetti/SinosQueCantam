<!--Pagina de contato-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez  
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/Logoo.png">  <!--icone da aba do navegador-->
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>
    <title>Fale Conosco</title> <!-- titulo no navegador -->
</head>
<body>

    <header> <!--menu superior-->
        <div class="barrasuperior">
            <div class="iconprivacidade"><img src="img/privacidade.png" width="25px" height="25px"></div>
            <div class="politicaprivacidade"><a href="politicadeprivacidade.html">Política de Privacidade</a></div>
            <div class="toptelefone">(32) 0000-0000</div>
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
        
    <div class="section">       
        <div class="falec">
            <br><h1>ENTRE EM CONTATO</h1><br><br>
            <div class="faleconosco">
                <div class="foto">
                    <img src="https://res.cloudinary.com/dsqk31h5n/image/upload/v1670343880/Trabalho%20Banco%20de%20Dados/67645450-e041-45b1-91aa-37bafdbf1375_irtiao.jpg" height="222 px" width="100%">
                </div>
                <div class="descquarto">
                    <h5><p style = 'color: #FFAC33;'> EMAIL:</p></h5> <h6>DUVIDAS@SINOSQUETOCAM.COM.BR</h6><br><br>
                    <h5><p style = 'color: #FFAC33;'> TELEFONE:</p><h5> <h6>(32) 0000-0000 -  (32) 0000-0000</h6><br><br>
                    <h5><p style = 'color: #FFAC33;'> WHATSAPP:</p></h5> <h6>(32) 90000-0000</h6><br><br> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>