<?php

class usuario
{
    private $pdo;
    public $msgErro = ""; //verificar se ha algum erro

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch(PDOException $e){
            global $msgErro;
            $msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nome, $telefone, $usuario, $email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");

        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false;

        }
        else
        {
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, usuario, email, senha ) VALUES (:n, :t, :u, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":u",$usuario);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",($senha));
            $sql->execute();
            return true;

        }
        

    }

    public function logar($email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",($senha));
        $sql->execute();

        if($sql->rowCount()> 0){
            
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //Login ok
        }
        else
        {    
            return false; // Não foi possivel logar

        }
    }

    
    
}










?>