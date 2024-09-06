<!--Pagina dos quartos de um determinado hotel-->
<?php
    session_start();
    ob_start();
    include_once 'conexao.php'; // Banco de dados incluido apenas uma vez

    $_SESSION['CNPJ'] = filter_input(INPUT_GET, "CNPJ_hotel");
    //var_dump(($CNPJ));
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/Logoo.png">  <!--icone da aba do navegador-->
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>
    <title>Quartos</title> <!-- titulo no navegador -->
    
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

    <div class="section"> <!--barra de pesquisa-->
       <div class="barrabusca">
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

       <div class="quartos">
            <?php //SELECT para mostrar o nome do hotel selecionado
            $query_hotel = "SELECT HNome, Cidade FROM hotel WHERE CNPJ = $_SESSION[CNPJ]"; //Cria a query
            $result_hotel = $conexao->prepare($query_hotel); //Prepara a query para execucao
            $result_hotel->execute(); //Execucao da query
            $row_hotel = $result_hotel->fetch(PDO::FETCH_ASSOC); //le os dados com o fetch
            extract($row_hotel);
            ?>
            <h4><?php echo "Hotel: $HNome - $Cidade";?></h4><br>
            <h4>Quartos</h4><br>

            <?php            
            //SELECT para mostrar todos os quartos do hotel selecionado
            $query_quartos = "SELECT * FROM quarto WHERE CNPJ = $_SESSION[CNPJ]"; //Cria a query
            $result_quartos = $conexao->prepare($query_quartos); //Prepara a query para execucao
            $result_quartos->execute(); //Execucao da query

            if($result_quartos->rowCount() == 0){ //se nao tiver quartos disponiveis
                echo "<h7> Não há quartos disponiveis neste hotel!<h7>";
            }else { //caso tenha, cria arrays, para guardar atributos de todos os quartos
                $numeroQuarto = array();
                $tipoQuarto = array();
                $valor = array();
                $url = array();
                $cont = 0;
                while ($row_quartos = $result_quartos->fetch(PDO::FETCH_ASSOC)){;  //le os dados com o fetch para cada quarto
                    $numeroQuarto[$cont] = $row_quartos['NumQuarto'];
                    $tipoQuarto[$cont] = $row_quartos['Tipo'];        
                    $valor[$cont] = $row_quartos['Valor'];
                    $url[$cont] = $row_quartos['Link_Quarto'];
                    ?>
                    <div class="quartodois">
                        <div class="foto">
                            <img src='<?php echo $url[$cont]; ?>' height="220px" width="100%">
                        </div>
                        <div class="descquarto">
                            <div class="desesquerda">
                                <h5><?php echo "Quarto $numeroQuarto[$cont]";?> </h3> <br> <br> <!--nome do quarto-->
                                <h6><?php echo "Quarto $tipoQuarto[$cont]"; ?> </h6><br><br><br> <!-- tipo do quarto-->
                            </div>
                            <div class="desdireita">
                                <h6>Valor da Reserva</h6><br>
                                <h6>R$ <?php echo $valor[$cont]; ?></h6><br> <!--valor da reserva-->                        
                            </div>
                        </div>
                    </div>
                <?php
                $cont++;
                }                 
            }
            if(isset ($_SESSION['Email']) == true) { ?> <!-- se estiver logado pode fazer reserva -->
                <button name=bt-reservar id=bt_reservar class="trigger">Reservar</button>                                                                                  
            <?php } else {?>
                    <br><br>
                    <div> 
                        <a href="login.html"><input id="bt-reservar" type="button" value="Faça login para RESERVAR!"></a>
                    </div>   
            <?php } ?>                                                                   
            
            <!-- Modal -->
            <div id="myModal" class="modal">

                <!-- Conteúdo do Modal -->
                <div class="modal-content">
                    <span class="close">&times;</span><br><br>
                    <form method="post" action="realizar_reserva.php"> 
                        
                        <p> 
                            <center><label id="rcidade" for="rcidade">HOTEL</label><br></center> <!--hotel ja foi definido antes então só tem ele de opção-->
                            <select id="rcidade" name="rcidade" required="required">
                                <option value="<?php echo $HNome[$cont]?>"> <?php echo $HNome ?></option>
                            </select>
                        </p><br>

                        <p> 
                            <center><label id="rcidade" for="rcidade">CIDADE</label><br></center> <!--cidade ja foi definida antes então só tem ela de opção-->
                            <select id="rcidade" name="rcidade" required="required">
                                <option value="<?php echo $Cidade[$cont]?>"> <?php echo $Cidade ?></option>
                            </select>
                        </p><br>

                        <p> 
                            <center><label id="rentrada" for="rentrada">ENTRADA</label><br></center>
                            <input id="rentrada" name="rentrada" required="required" type="date" placeholder="DD/MM/AAAA"/>
                        </p><br>
            
                        <p> 
                            <center><label id="rsaida" for="rsaida">SAÍDA</label><br></center>
                            <input id="rsaida" name="rsaida" required="required" type="date" placeholder="DD/MM/AAAA"/>
                        </p><br>
            
                        <p> 
                            <center><label id="rquartos" for="rquartos">QUARTO</label><br></center> <!--quarto ja foi definido antes então só tem ele de opção-->
                            <select id="rquartos" name="rquartos" required="required">
                                <?php
                                $numero = 1;
                                while($numero  <= count($numeroQuarto)){?>
                                    <option value="<?php echo $numero ?>"><?php echo $numero ?></option>
                                <?php 
                                $numero++;
                                } ?>
                            </select> 
                        </p><br>

                        <p> 
                            <center><label id="rhospedes" for="rhospedes">HOSPEDES</label><br></center>
                            <select id="rhospedes" name="rhospedes" required="required">
                                <option value="1">1</option> 
                                <option value="2">2</option>
                                <option value="3">3</option>                               
                            </select> 
                        </p><br>
                    
                        <p> 
                            <center><label id="cupom" for="cupom">CUPOM</label><br></center>
                        <input id="cupom" name="cupom" type="text"/>
                        </p><br>
                            
                        <p> 
                            <center><input name="renviar" id="renviar" type="submit" value="Reservar" /> </center>
                        </p>
                        
                    </form>
                </div>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById("myModal");
                
                // Get the button that opens the modal                            
                var btn = document.getElementById("bt_reservar");    
                btn.style.width = "100%";
                btn.style.height = "45px";
                btn.style.borderRadius = "10px";
                btn.style.border = "none";
                btn.style.backgroundColor = "#FFAC33";
                btn.style.fontFamily = "Hammersmith One";
                btn.style.fontSize = "15px";
                btn.style.marginTop = "5px";
                btn.style.cursor = "pointer";                                
                
                // Get the <span> element that closes the modal                        
                var span = document.getElementsByClassName("close")[0];                                    
                
                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                modal.style.display = "block";
                }                  
                
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                modal.style.display = "none";
                }
               
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                }
            </script>          
        </div>
    </div>
</body>
</html>