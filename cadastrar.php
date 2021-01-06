<?php
    require_once 'CLASSES/usuarios.php';
    $u = new usuario;
?>
<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <title>cadastrar</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>

<body>
<div id="corpo-form-Cad" >
    <h1 style="color: white;" >Cadastre-se</h1>
    <form method="POST" >
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="50">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="text" name="usuario" placeholder="Usuario" maxlength="30">
        <input type="email" name = "email" placeholder="E-mail" maxlength="50">
        <input type="password" name = "senha" placeholder="Senha" maxlength="32">
        <input type="password" name = "confsenha" placeholder="Confirmar Senha" maxlength="32">
        <input type="submit" value="Cadastrar">
        <a href="index.php"><strong>Ir para tela de login</strong></a>
    
    </form>
</div>
<?php

if (isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confsenha = addslashes($_POST['confsenha']);

    if (!empty($nome) && !empty($telefone) && !empty($usuario) && !empty($email) && !empty($senha) && !empty($confsenha))
    {
        $u->conectar("projeto_apinfo","localhost","root","");
        if($u->msgErro == "")
        {

            if($senha == $confsenha)
            {
                if($u->cadastrar($nome,$telefone,$usuario,$email,$senha)){
                    ?>
                    <div id="msg-sucesso">
                        Cadastrado com sucesso!
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                        Email já cadastrado!
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        As senhas não correspondem!
                    </div>
                    <?php
            
            }
            
        }
        else
        {
            ?>
                    <div class="msg-erro">
                        <?php echo "ERRO: ".$u->msgErro; ?>
                    </div>
                    <?php
            
            
        }
    }
    else
        {
            ?>
                    <div class="msg-erro">
                        Preencha todos os campos!
                    </div>
                    <?php
        }  
}
?>
</body>

</html>