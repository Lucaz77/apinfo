<?php
    require_once 'CLASSES/usuarios.php';
    $u = new usuario;
?>

<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title> Login</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>

<body>
<div id="corpo-form" >
    <h1 style="color: white;" >Entrar</h1>
    <form method="POST">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Senha" name="senha">
        <input type="submit" value="Acessar">
        <a href="cadastrar.php">Ainda não é cadastrado?<strong>Cadastre-se!</strong></a>
    
    </form>
</div>
<?php
if (isset($_POST['email']))
{  
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);


        if (!empty($email) && !empty($senha))
        {
        $u->conectar("projeto_apinfo","localhost","root","");
        if($u->msgErro == "")
        {
            if($u->logar($email,$senha))

            {
                header("location: areaprivada.php");
            }
            else
                
            {
                echo "Email e/ou senha estão incorretos!";
            }
        }       
        else
        {
        echo "Erro: ".$u->msgErro;
        }                
        }else
    {
        echo "Preencha todos os campos!";
    }

    }

?>

</body>
</html>