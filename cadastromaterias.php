<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('portal');

 //--- pesquisar categorias para select -------
 
 $sql_regiao       = "SELECT codigo, nome FROM regiao ";
 $pesquisar_regiao = mysql_query($sql_regiao);

 //--- pesquisar categorias para select -------
 
$sql_categorias       = "SELECT codigo, nome FROM categorias ";
$pesquisar_categorias = mysql_query($sql_categorias);

 //--- pesquisar colunistas para select -------

$sql_colunistas      = "SELECT codigo, nome FROM colunistas ";
$pesquisar_colunistas = mysql_query($sql_colunistas);

// --------------------------------

if (isset($_POST['gravar']))
{
$codigo       = $_POST['codigo'];
$data    = $_POST['data'];
$hora    = $_POST['hora'];
$codregiao  =$_POST['codregiao'];
$codcategoria = $_POST['codcategoria'];
$codcolunista = $_POST['codcolunista'];
$chamada       = $_POST['chamada'];
$resumo        = $_POST['resumo'];
$materia  = $_POST['materia'];
$fotochamada       = $_FILES['fotochamada'];
$foto1        = $_FILES['foto1']; // campos fotos
$foto2        = $_FILES['foto2']; // campos fotos

$error = 0;


// ------verificar op�oes do arquivo fotos anexadas ----

// Se a foto estiver sido selecionada
if (!empty($fotochamada['name']))
{
// Verifica se o arquivo anexado nao e uma imagem (extensoes)
if(!preg_match("/^image\/(jpg|jpeg|png|bmp)$/",$fotochamada['type'])){
    $error[1] = "NAO � uma imagem...";
    }
		// Se nao houver nenhum erro na foto anexada
		if ($error == 0)
        {
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$fotochamada['name'],$ext);

        	// Gera um nome unico para a imagem
        	$nome_imagem = $fotochamada['name'];

        	// Caminho de onde armazena a imagem (pasta criada para fotos)
        	$caminho_imagem = "fotos/".$nome_imagem;

            // Faz o upload da imagem para seu respectivo caminho (pasta criada para fotos)
			move_uploaded_file($fotochamada['tmp_name'],$caminho_imagem);

        	// Gera um nome unico para a imagem
        	$nome_imagem1 = $foto1['name'];

        	// Caminho de onde armazena a imagem (pasta criada para fotos)
        	$caminho_imagem1 = "fotos/".$nome_imagem1;

			// Faz o upload da imagem para seu respectivo caminho (pasta criada para fotos)
			move_uploaded_file($foto1['tmp_name'],$caminho_imagem1);

            $nome_imagem2 = $foto2['name'];

        	// Caminho de onde armazena a imagem (pasta criada para fotos)
        	$caminho_imagem2 = "fotos/".$nome_imagem2;

			// Faz o upload da imagem para seu respectivo caminho (pasta criada para fotos)
			move_uploaded_file($foto2['tmp_name'],$caminho_imagem2);

// colocar o caminho das imagens na tabela do banco


$sql = "INSERT INTO materias (codigo,data,hora,codregiao,codcategoria,codcolunista,chamada,resumo,
materia,fotochamada,foto1,foto2)
        VALUES ('$codigo','$data','$hora','$codregiao','$codcategoria','$codcolunista','$chamada','$resumo',
        '$materia','$caminho_imagem','$caminho_imagem1','$caminho_imagem2')";

$resultado = mysql_query($sql);
echo $resultado;
if ($resultado)
{
   echo 'Dados cadastrados com Sucesso';
}
else
{  echo 'Erro ao cadastrar os dados...'; }

}
}
}

if (isset($_POST['alterar']))
        {
            $codigo       = $_POST['codigo'];
            $data    = $_POST['data'];
            $hora    = $_POST['hora'];
            $codregiao  =$_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada       = $_POST['chamada'];
            $resumo        = $_POST['resumo'];
            $materia  = $_POST['materia'];
            $fotochamada       = $_FILES['fotochamada'];
            $foto1        = $_FILES['foto1']; // campos fotos
            $foto2        = $_FILES['foto2']; // campos fotos

            //comando MYSQL para alterar no banco
            $sql = "update materias set chamada= '$chamada', resumo= '$resumo', materia= '$materia', fotochamada= '$fotochamada',
                    foto1 = '$foto1', foto2 = '$foto2'
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
            $codigo       = $_POST['codigo'];
            $data    = $_POST['data'];
            $hora    = $_POST['hora'];
            $codregiao  =$_POST['codregiao'];
            $codcategoria = $_POST['codcategoria'];
            $codcolunista = $_POST['codcolunista'];
            $chamada       = $_POST['chamada'];
            $resumo        = $_POST['resumo'];
            $materia  = $_POST['materia'];
            $fotochamada       = $_FILES['fotochamada'];
            $foto1        = $_FILES['foto1']; // campos fotos
            $foto2        = $_FILES['foto2']; // campos fotos

            //comando MYSQL para alterar no banco
            $sql = "delete from materias
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

        if (isset($_POST['pesquisar']))
        {
            $sql = "select * from materias";
            $resultado = mysql_query($sql);
            
            echo $sql;
            //verifica o resultado da pesquisa (0 ou 1)
            if (mysql_num_rows($resultado) == 0)
            {
                echo "Sua pesquisa não retornou resultados..."; 
            }
            else
            {
                echo "Resultado da pesquisa das materias: "."<br>";
                //mostrar na tela os valores encontrados
                while($materias = mysql_fetch_array($resultado))
                {
                    echo "Codigo: ".$materias['codigo']."<br><br>".
                    "Data: ".$materias['data']."<br><br>".
                    "Hora: ".$materias['hora']."<br><br>".
                    "Cod Região: ".$materias['codregiao']."<br><br>".
                    "Cod Categorias: ".$materias['codcategoria']."<br><br>".
                    "Cod Colunistas: ".$materias['codcolunista']."<br><br>".
                    "Chamada: ".$materias['chamada']."<br><br>".
                    "Resumo: ".$materias['resumo']."<br><br>".
                    "Materia: ".$materias['materia']."<br><br>".
                    "Foto Chamada: "."<br>".
                    utf8_encode('<img src="'.$materias['fotochamada'].'" heigth="100" width="150" />')."<br><br>".
                    "Fotos      : "."<br>".
                    utf8_encode('<img src="'.$materias['foto1'].'" heigth="100" width="150" />')."<br>".
                    utf8_encode('<img src="'.$materias['foto2'].'" heigth="100" width="150" />')."<br><hr>";
                }
            }                          

        }

        
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro Colunistas</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastromaterias.php"  enctype="multipart/form-data">
        <h1>Cadastro dos Colunistas - Portal de Noticia 
        </h1><br><br>
        Codigo: <input type ="text" name="codigo" id="codigo" size="10">
        <br><br>
        Data: <input type ="date" name="data" id="data" size="50">
        <br><br>
        Hora: <input type ="time" name="hora" id="hora" size="50">
        <br><br>
        Cod Região:
        <select name="codregiao" id="codregiao">
        <option value=0>Selecinar a região</option>
        <?php
        if(mysql_num_rows($pesquisar_regiao) <> 0)
        {
            while($regiao= mysql_fetch_array($pesquisar_regiao))
            {
                echo '<option value="'.$regiao['codigo'].'">'.
                                       $regiao['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cod Categorias:
        <select name="codcategoria" id="codcategoria">
        <option value=0>Selecinar a Categoria</option>
        <?php
        if(mysql_num_rows($pesquisar_categorias) <> 0)
        {
            while($categorias= mysql_fetch_array($pesquisar_categorias))
            {
                echo '<option value="'.$categorias['codigo'].'">'.
                                       $categorias['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cod Colunista:
        <select name="codcolunista" id="codcolunista">
        <option value=0>Selecinar o Colunista</option>
        <?php
        if(mysql_num_rows($pesquisar_colunistas) <> 0)
        {
            while($colunistas= mysql_fetch_array($pesquisar_colunistas))
            {
                echo '<option value="'.$colunistas['codigo'].'">'.
                                       $colunistas['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Chamada: <input type ="text" name="chamada" id="chamada" size="100">
        <br><br>
        Resumo: <input type ="text" name="resumo" id="resumo" size="100">
        <br><br>
        Materia: <br><textarea name="materia" id="materia" rows=6 cols=70></textarea>
        <br><br>
        Foto Chamada: <input type ="file" name="fotochamada" id="fotochamada" size="50">
        <br><br>
        Foto1: <input type ="file" name="foto1" id="foto1" size="50">
        <br><br>
        Foto2: <input type ="file" name="foto2" id="foto2" size="50">

        <br><br> 
        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>