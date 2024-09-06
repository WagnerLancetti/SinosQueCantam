<!--Pagina do adm-->

<?php
    session_start();
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
                    }?>
                    <a href="login.html"><img id="iconlogin" src="img/iconlogin.png"></a>
                    <div class="flogin"><b>Seja bem-vindo,<b>
                    <b><?php echo ($_SESSION['Pnome']); ?></b>
                    <br><a href="doLogout.php"><b>Sair<b></a>
                </div>
            </div>
        </div>
    </header>

    <div class="menulateral">
        <center>
        <br><b>RELATÓRIOS</b>
        <div id="mrelatorio" >
            <br>
            <div class="mlreservas"><a href="rreservas.php">Quantidade de Reservas</a></div>
            <hr>
            <div class="mlreceitatotal"><a href="rreceitatotal.php">Receitas Totais</a></div>
            <hr>
            <div class="mlcupons"><a href="rquartosreservados.php">Quartos Reservados</a></div>
            <hr>
            <div class="mlcupons"><a href="rquartoshospedados.php">Quartos Hospedados</a></div>
            <hr>
            <div class="mlcupons"><a href="rcuponscadastrados.php">Cupons Cadastrados</a></div>
            <hr>
            <!---<div class="mlcupons"><a href="rdatasmaisatrativas.php">Datas Mais Atrativas</a></div>-->
        </div>
        </center>
    </div>


    <center>
    <div class="corpo2">
    <br><br><br><h2><b>Cadastrar Cupom:</b></h2><br>
    <form method="POST" action="cadcupom.php">
        <label for="codigo"><h6>Código do cupom:</h6></label>
        <input type="text" id="codigoc" name="codigoc"/>
    
        <label for="desconto"><h6>Desconto:</h6></label>
        <input type="text" id="porc" name="desconto" required="required"  />
        
        <input name="CadCupom" id= "bcupom" type="submit" value="Continuar" required="required" /> 
    </form>
    </center>
    </div>


    <center>
    <div class="corpo2">
    <br><br><br><h2><b>Cadastrar Hotel:</b></h2><br>

    <form method="POST" action="cadhotel.php">
        <label for="CNPJ"><h6>CNPJ:</h6></label>
        <input type="text" id="codigoc" name="CNPJ" pattern="[0-9]+$" minlength="14" maxlength="14" required="required"/>
        <br><br>

        <label for="HNome"><h6>Nome Hotel:</h6></label>
        <input type="text" id="codigoc" name="HNome" required="required"/>
        <br><br>

        <label for="CEP"><h6>CEP:</h6></label>
        <input type="text" id="codigoc" name="CEP" pattern="[0-9]+$" minlength="8" maxlength="8" required="required"/>
        <br><br>

        <label for="Numero"><h6>Número:</h6></label>
        <input type="text" id="codigoc" name="Numero" pattern="[0-9]+$" required="required"/>
        <br><br>

        <label for="Cidade"><h6>Cidade:</h6></label>
        <input type="text" id="codigoc" name="Cidade" required="required"  />
        <br><br>

        <label for="CafeManha"><h6>Café da Manhã:</h6></label>
        <select name="CafeManha" id="codigoc" required="required" >
            <option value="0">Tem</option>
            <option value="1">Não Tem</option>
        </select>

        <br><br>
        <label for="Link_Hotel"><h6>Link_Hotel:</h6></label>
        <input type="text" id="codigoc" name="Link_Hotel" placeholder = "Link Cloudinary"/>
        <br><br>

        <input name="CadHotel" id= "bcupom" type="submit" value="Continuar"/>

    </form>
    <br><br>
    </center>
    </div>


    <center>
    <div class="corpo2">
    <br><br><br><h2><b>Cadastrar Quarto:</b></h2><br>

    <form method="POST" action="cadquarto.php">
        <label for="NumQuarto"><h6>NumQuarto:</h6></label>
        <input type="text" id="codigoc" name="NumQuarto" pattern="[0-9]+$" required="required" />
        <br><br>

        <label for="Tipo"><h6>Tipo:</h6></label>
        <select name="Tipo" id="codigoc"  required="required" >
            <option value="Individual">Individual</option>
            <option value="Duplo">Duplo</option>
            <option value="Triplo">Triplo</option>
            <option value="Família">Família</option>
        </select>
        <br><br>

        <label for="Valor"><h6>Valor:</h6></label>
        <input type="text" id="codigoc" name="Valor" required="required" />
        <br><br>

        <label for="CNPJ"><h6>CNPJ:</h6></label>
        <input type="text" id="codigoc" name="CNPJ" pattern="[0-9]+$" minlength="14" maxlength="14" required="required" />
        <br><br>

        <label for="Link_Quarto"><h6>Link_Quarto:</h6></label>
        <input type="text" id="codigoc" name="Link_Quarto" />
        <br><br>

        <input name="CadQuarto" id= "bcupom" type="submit" value="Continuar"/>

    </form>
    <br><br>
    </center>
    </div>

</body>
</html>