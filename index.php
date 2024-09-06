<!--Pagina principal-->
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
    <title>Rede de Hoteis</title> <!-- titulo no navegador -->
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
        <div class="barrabusca"> <!--barra de pesquisa-->
            <form method="post" action="busca.php"> 
                <div class="boxcidade">
                    <label for="cidade">Cidade</label><br>
                    <select id="cidade" name="cidade" required="required">
                        <option value="" data-default disabled selected>Cidade</option>
                        <?php  //SELECT para mostrar todos os hoteis na opção de busca
                        $query_cidades = "SELECT DISTINCT Cidade FROM hotel"; //Cria a query
                        $result_cidades = $conexao->prepare($query_cidades); //Prepara a query para execucao
                        $result_cidades->execute(); //Execucao da query
                        while ($row_cidades = $result_cidades->fetch(PDO::FETCH_ASSOC)){;  //le os dados com o fetch para cada hotel
                        ?>
                            <option value="<?php echo $row_cidades['Cidade']; ?>"> <?php echo $row_cidades['Cidade']; ?></option>
                        <?php }?>
                    </select> 
                </div>  
                                
                <div class="boxdata">
                    <label for="data">Data</label><br>
                    <input id="data" name="data" required="required" type="datetime-local"/>
                </div>

                <div class="boxviajantes">
                    <label for="viajantes">Viajantes</label><br>
                    <select id="viajantes" name="viajantes" required="required">
                        <option value="1">1 viajantes, 1 quarto</option>
                        <option value="2">2 viajantes, 1 quarto</option>
                        <option value="3">3 viajantes, 1 quarto</option>
                    </select>
                </div>

                <div class="boxpesquisa">
                    <input name="pesquisar" id="pesquisar" type="submit" value="BUSCAR"/> 

                </div>
            </form>
        </div>    
    
        
        <br><br><h4>HOTÉIS</h4>
        <?php                         
        //SELECT para mostrar todos os hoteis abaixo da barra de busca.
        $query_hoteis = "SELECT  * FROM hotel"; //Cria a query
        $result_hoteis = $conexao->prepare($query_hoteis); //Prepara a query para execucao
        $result_hoteis->execute(); //Execucao da query    
        if($result_hoteis->rowCount() != 0){ //se tiver hoteis
            $nomeHoteis = array();
            $faixaPreco = array();
            $cidadeHotel = array();
            $cafeManha = array();
            $url = array();
            $CNPJ = array();
            $cont = 0;
            while ($row_hoteis = $result_hoteis->fetch(PDO::FETCH_ASSOC)){;  //le os dados com o fetch para cada hotel
                $nomeHoteis[$cont] = $row_hoteis['HNome'];
                $faixaPreco[$cont] = $row_hoteis['FaixaPreco'];
                $cidadeHotel[$cont] = $row_hoteis['Cidade'];
                $cafeManha[$cont] = $row_hoteis['CafeManha'];        
                $url[$cont] = $row_hoteis['Link_Hotel'];
                $CNPJ[$cont] = $row_hoteis['CNPJ'];
                ?>
                <div class="quartos">
                    <div class="quartodois">
                        <div class="foto">
                            <img src='<?php echo $url[$cont]; ?>' height="220px" width="100%">
                        </div>
                        <div class="descquarto">
                            <div class="desesquerda">
                                <h5> <?php echo $nomeHoteis[$cont];?> </h5> <br> <br> <!--printa nome do Hotel-->
                                <h6>Quartos: individual, duplo e triplo</h6><br><br><br>
                                <?php if($cafeManha[$cont]==0){ ?>
                                <img src="img/cafemanha.png" width="20px" height="20px"> <h6>Café da Manhã Incluso</h6> 
                                <?php }else{?> 
                                <img src="img/cafemanhared.png" width="20px" height="20px"><h7>Café da Manhã Não Incluso </h7> <?php } ?> <!--printa cafe da manha-->
                            </div>
                            <div class="desdireita">
                                <h6>Faixa de Preço</h6><br>
                                <h6> R$<?php echo $faixaPreco[$cont];?></h6><br> <!--printa faixa de preço-->
                                <a href='quartos.php?CNPJ_hotel=<?php echo $CNPJ[$cont] ?>'><input id="bt-reservar" type="button" value="Ver Quartos"></a>
                            <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            $cont++;
            } 
        }
        ?>
    </div>
   
</body>
</html>