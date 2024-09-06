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
                <?php  if(($_SESSION['TipoAdm']) == '0'){ 
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

    <?php    
    $query_reservas = "SELECT * FROM Cupom"; //cria a query
    $reservas_user = $conexao->prepare($query_reservas); // Prepara a query para execucao
    $reservas_user -> execute(); // Execucao da query

    if($reservas_user->rowCount() != 0){  //se tiver achado usuario
        ?>
        <center>
        <div>
            <center><h1>Relatório Cupons Cadastrados</h1><br></center>
            <table border="1" align="center">
            <tr>
                <td>Código</td>
                <td>Desconto</td>
            </tr>
        <?php
        while($row = $reservas_user->fetch(PDO::FETCH_ASSOC)) {
            extract($row) //feth_assoc para poder imprimir atraves do nome da coluna ?>
            <tr>
                <td><center><?php echo $row["Codigo"]; ?></center></td>
                <td><center><?php echo $row["Desconto"]; ?></center></td>
            </tr>
            
        <?php } ?>
        </div>
        </center>
        
        <div>
            <center><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Voltar</a><br><br></center>
        </div>
        
        <?php
    }else{
        echo "<p style='color: #ff0000;'>Você não possui reservas!!</p>";
        echo $_SESSION['CPF'];
    }

?>
</body>
</html>
