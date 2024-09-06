<!-- Permite a coneção do projeto php com o banco de dados.-->
<?php

//Variáveis
 $server = (String)"localhost";  //local onde está o banco
 $user = (String) "root";
 $password = (String) "#Testebd";   //lembrar de colocar a senha
 $dataBase = (String) "hotelsinosquecantam";
 $port = 3306;

//Conexao com o BD:
try{
    $conexao = new PDO("mysql:host=$server;port=$port;dbname=".$dataBase, $user, $password);
}catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>