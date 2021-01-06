<?php
    require_once 'CLASSES/classepessoas.php';
    $p = new Pessoa ("projeto_apinfo","localhost","root","");
?>
<?php
    require_once 'CLASSES/usuarios.php';
    $u = new usuario;
?>


<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title> Crud </title>
    <link rel="stylesheet" href="CSS/incio.css">
</head>

<body>
<?php
    if(isset($_GET['id_up']))
    {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscardadospessoa($id_update);
    }



?>


<section id="esquerda">
        <form method="POST" >
        <h2 style="color: white;" >Atualizar os dados</h2>
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="50" value="<?php if(isset($res)){echo $res['nome'];} ?>">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30" value="<?php if(isset($res)){echo $res['telefone'];} ?>">
        <input type="text" name="usuario" placeholder="Usuario" maxlength="30" value="<?php if(isset($res)){echo $res['usuario'];} ?>">
        <input type="email" name = "email" placeholder="E-mail" maxlength="50" value="<?php if(isset($res)){echo $res['email'];} ?>">
        <input type="submit" value="Atualizar">
        </form>
    </section>

    <section id="direita">
    <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Usuario</td>
                <td>Telefone</td>
                <td colspan="2">E-mail</td>
            </tr>
        <?php
           $res = $p ->buscardados();
            if(count($res)> 0)
            {
                for($i=0; $i <count($res); $i++) 
                {
                    echo "<tr>";
                    foreach ($res[$i] as $k => $v){
                        if($k != "id_usuario" and $k != "senha" and $k != "confsenha") 
                        {
                            echo "<td>".$v."</td>";
                        } 

                    }
                    ?>
                     <td>
                        <a href="areaprivada.php?id_up=<?php echo $res[$i]['id_usuario'];?>">Editar</a>
                        <a href="areaprivada.php?id_usuario=<?php echo $res[$i]['id_usuario'];?>">Excuir</a>
                    </td>
                    <?php
                    echo "</tr>";
                }
                
            }    
                
            

         ?>
            
    

    
    </form>
                

        </table>
    
    </section>
    
//<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>
<a href="sair.php"> Sair </a>


<?php

if (isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);


    if (!empty($nome) && !empty($telefone) && !empty($usuario) && !empty($email) )
    {
        $u->conectar("projeto_apinfo","localhost","root","");
     

                  if(isset($_GET['id_up']) )
                    {

                            $id_usuario = addslashes($_GET['id_up']);
                            $nome = addslashes($_POST['nome']);
                            $telefone = addslashes($_POST['telefone']);
                            $usuario = addslashes($_POST['usuario']);
                            $email = addslashes($_POST['email']);

                                                             
                                
                                $p->atualizardados($id_usuario, $nome, $usuario, $telefone, $email);
                                header("location: areaprivada.php");
                                    ?>
                                    <div id="msg-sucesso">
                                    Atualizado com sucesso!
                                    </div>
                                    <?php
                                
                        }
                    }    
           
        
    
}
?>

</body>

</html>

<?php

    if(isset($_GET['id_usuario']))
    {
        $id_pessoa = addslashes($_GET['id_usuario']);
        $p->excluirPessoa($id_pessoa);
        header("location: areaprivada.php");
    }


?>