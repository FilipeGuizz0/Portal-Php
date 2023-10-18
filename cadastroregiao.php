<?php
//conectar ao servidor e ao banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("portal");


//se escolher a opção GRAVAR
if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$nome = $_POST['nome'];

//comando MYSQL para gravar no banco
$sql = "insert into regiao (codigo,nome) 
        values ('$codigo','$nome')";

//executar o comando SQL no banco de dados
$resultado = mysql_query($sql);

//verificar se gravou (sem erros)
if ($resultado)
{
    echo "Dados gravados com sucesso!";
}
else
{
    echo "ERRO ao gravar...!";
} 
} //encerrar o botão gravar



//se escolher a opção ALTERAR
if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    
    //comando MYSQL para alterar no banco
    $sql = "update regiao set nome = '$nome' 
            where codigo = '$codigo'";
    
    //executar o comando SQL no banco de dados
    $resultado = mysql_query($sql);
    
    //verificar se alterou (sem erros)
    if ($resultado)
    {
        echo "Dados alterados com sucesso!";
    }
    else
    {
        echo "ERRO ao alterar...!";
    } 
     //encerrar o botão gravar
}



//se escolher a opção EXCLUIR
if (isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    
    //comando MYSQL para alterar no banco
    $sql = "delete from regiao
            where codigo = '$codigo'";
    
    //executar o comando SQL no banco de dados
    $resultado = mysql_query($sql);
    
    //verificar se alterou (sem erros)
    if ($resultado)
    {
        echo "Dados excluidos com sucesso!";
    }
    else
    {
        echo "ERRO ao excluir...!";
    } 
     //encerrar o botão gravar
}



//se escolher a opção PESQUISAR
if (isset($_POST['pesquisar']))
{
    $sql = "select * from regiao";
    $resultado = mysql_query($sql);

    //verifica o resultado da pesquisa (0 ou 1)
    if (mysql_num_rows($resultado) == 0)
    {
        echo "Sua pesquisa não retornou resultados..."; 
    }
    else{
        echo "Resultado da pesquisa das regiao: "."<br>";
        //mostrar na tela os valores encontrados
        while($regiao = mysql_fetch_array($resultado))
        {
            echo "Codigo: ".$regiao['codigo']."<br>".
            "Nome: ".$regiao['nome']."<br><br>";
        }
    }                          
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro Região</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastroregiao.php">
        <h1>Cadastro das Regiões - Portal de Noticia 
        </h1><br><br>
        Codigo: <input type ="text" name="codigo" id="codigo" size="10">
        <br><br>
        Nome: <input type ="text" name="nome" id="nome" size="50">
        <br><br>
        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>