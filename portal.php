<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('portal');

 //--- pesquisar  para select -------

$sql_      = "SELECT codigo, nome FROM  ";
$pesquisar_ = mysql_query($sql_);

 //--- pesquisar categorias para select -------

$sql_categorias       = "SELECT codigo, nome FROM categorias ";
$pesquisar_categorias = mysql_query($sql_categorias);

 //--- pesquisar colunistas para select -------

$sql_colunistas       = "SELECT codigo, nome FROM colunistas ";
$pesquisar_colunistas = mysql_query($sql_colunistas);

$vazio = 0;
//---------------------------------------------------------------------------------------


if(!empty($_POST['pesq_']))
{
    $  = (empty($_POST['cod']))? 'null' : $_POST['cod'];

    if ($ <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.data, materias.hora, materias.chamada
                      FROM materias, 
                      WHERE materias.cod = .codigo and
                      materias.cod ='$'";
     
     $seleciona_materias = mysql_query($sql_materias);
     
     
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_categoria']))
{
    $categoria  = (empty($_POST['codcategoria']))? 'null' : $_POST['codcategoria'];

    if ($categoria <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.data, materias.hora, materias.chamada
                      FROM materias, categorias
                      WHERE materias.codcategoria = categorias.codigo and
                      materias.codcategoria ='$categoria'";


     $seleciona_materias = mysql_query($sql_materias);
     
     
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_colunista']))
{
    $colunista  = (empty($_POST['codcolunista']))? 'null' : $_POST['codcolunista'];

    if ($colunista <> '')
    {
     $sql_materias = "SELECT materias.fotochamada, materias.data, materias.hora, materias.chamada
                      FROM materias, colunistas
                      WHERE materias.codcolunista = colunistas.codigo and
                      materias.codcolunista ='$colunista'";

     $seleciona_materias = mysql_query($sql_materias);
     
    
     $vazio = 1;
     }
}



?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logo.png" type="image/x-icon">
        <title>Sala de Noticias SN</title>
        <link rel="stylesheet" type="text/css" href="stylee.css" />
    </head>
<body>
<div id="topo">
    <a href="portal.php">
        <img src="logo.png" class="logo"> 
    </a>
    <div class="usuario">
        <a href="login.php">
            <img src="usuario.png" class="usuario">
        </a>
    </div>
    <div class="dropdown">
        <span>Menu</span>
        <div class="dropdown-content">
        <p>
          <table>
              <tr>
                  <td width=400 height=20>
                      <form name="modelo" method="post" action="portal.php"> 
                          Categorias: <select name="codcategoria" id="codcategoria">
                              <option value=0 selected="selected">Selecione categoria ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_categorias) == 0)
                                {
                                echo '<h1>Sua busca por categorias n�o retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_categorias))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                                ?>
                              </select>
                              <input type="submit" name="pesq_categoria" id="pesq_categoria" value="Pesquisar">
                              </form>
                      </form>
                  <td>
              </tr>
              <tr>
                  <td width=400 height=20>
                      <form name="colunista" method="post" action="portal.php"> 
                          Colunistas: <select name="codcolunista" id="codcolunista">
                              <option value=0 selected="selected">Selecione o colunista ...</option>
                                <?php
                                if(mysql_num_rows($pesquisar_colunistas) == 0)
                                {
                                echo '<h1>Sua busca por colunistas n�o retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_colunistas))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                                ?>
                              </select>
                              <input type="submit" name="pesq_colunista" id="pesq_colunista" value="Pesquisar">
                      </form>
                  <td>
              </tr>
              <tr>
                  <td width=400 height=20>
                      <form name="" method="post" action="portal.php"> 
                          Regiões: <select name="cod" id="cod">
                              <option value=0 selected="selected">Selecione a região...</option>
                                <?php
                                if(mysql_num_rows($pesquisar_) == 0)
                                {
                                echo '<h1>Sua busca por  n�o retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                                ?>
                              </select>
                              <input type="submit" name="pesq_" id="pesq_" value="Pesquisar">
                      </form>
                  </td>
              </tr>
            </table>
            </p>
        </div>
    </div>
</div>
<div id="meio">
    <div id="resultado">
    <?php      
        if ($vazio == 0)
        {
        $sql_materias = "select fotochamada, data, hora, chamada
                        from materias
                        ORDER BY data LIMIT 3";
        $seleciona_materias = mysql_query($sql_materias);
        ?>      
        <b><h1>Noticias em Destaque: </h1></b><br>
        <table border=0 width= 620 height=720 align='center'>        
        <?php
        while($res = mysql_fetch_array($seleciona_materias))
                {
                echo '<td width=400 height=200><a href="materiacompleta.php?materia=$codigo">'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="180" width="350" />').'</a><br></td>';
                echo '<td width=250 height=20>'.$res['data'].' - '. $res['hora'].'<br>';                
                echo utf8_encode($res['chamada']).'</td></tr>';
                }
        }
        else
        {
        echo "<br>";
        echo '</table>';
        echo "<b><h1>Noticias pesquisadas: </h1></b>"."<br><br>";
        echo '<table border=0 width= 620 height=520 align=center>';
        while($res = mysql_fetch_array($seleciona_materias))
                {
                    echo '<tr><td width=400 height=200><a href="materiacompleta.php">'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="180" width="400" />').'</a><br></td>';
                    echo '<td width=200 height=20>'.$res['data'].' - '. $res['hora'].'<br>';                
                    echo utf8_encode($res['chamada']).'</td></tr>';
                }
        
        }
        
        ?>
    
        </table>
    </div>
    <div id="noticias"> 
    <table border=0  height=100  width= 200 align='center'>
    <b>Outras Noticias: </b><br><br><br>
    <?php   
      
        $sql_materias = "select fotochamada, data, hora, chamada
                        from materias
                        ORDER BY data LIMIT 4";
        $seleciona_materias = mysql_query($sql_materias);
              
        while($res = mysql_fetch_array($seleciona_materias))
        {
        echo '<tr><td width=200 height=100><a href="materiacompleta.php">'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="80" width="150" />').'</a><br></td></tr>';              
        echo '<tr><td>'.utf8_encode($res['chamada']).'<br><hr></td></tr>';
        }
        
        ?>
        </table>
    </div>
</div>
<div id="baixo">
    ©Desenvolvido por Filipe Guizzo 
</div>



</body>
</html>
