<?php
//conectar ao servidor e ao banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("portal");

if (isset($_POST['conectar']))
{
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $sql = "SELECT login, senha FROM colunistas
            WHERE login = '$login' AND senha = '$senha'";
    $resultado = mysql_query($sql);

    if(mysql_num_rows($resultado)  <> 0)
    {
        $colunistas = mysql_fetch_array($resultado);
        if ($colunistas["login"] !="") {
            $_SESSION['login'] = $colunistas['login'];
            $_SESSION['senha'] = $colunistas['senha'];
            header("Location: menuCadastro.html"); 
        }
    }
    else 
    {
        echo "Usuário Invalido ou não cadastrado !!!";
        header("Location: login.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>
<body>
    <br><br><br><br><br><br>
    <div id="loginMenu">
        <div id="tituloMenu">
            <img src="logo.png" class="logo">
        </div>
        <div id="opcaoMenu">           
            <h1>Login do Colunista</h1>
            <form name="formulario" method="post" action="login.php">
                Login <input type ="text" name="login" id="login" size="20">
                <br><br>
                Senha <input type ="password" name="senha" id="senha" size="20">
                <br><br>
                <input type="submit" name="conectar" id="conectar" value="Conectar">
            </form>
        </div>
    </div>
</body>
</html>