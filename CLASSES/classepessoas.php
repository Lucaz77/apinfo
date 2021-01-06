<?php

    Class Pessoa{

        private  $pdo;

        public function __construct($dbname,$host, $user, $senha)
        {
            try{
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);

            }catch (PDOException $e)
            {
                    echo "Erro com banco de dados: ".$e->getMessage();
                    exit();
            }
            catch (Exception $e)
            {
                echo "Erro generico : ".$e->getMessage();
                exit();
            }
            
        }

        public function buscardados()
        {
            $res = array();
            $cmd= $this->pdo->query("SELECT * FROM usuarios ORDER BY nome");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        
        public function excluirPessoa($id_usuario)
        {
            $cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario =:id");
            $cmd->bindValue(":id",$id_usuario);
            $cmd->execute();

        }

        public function buscardadospessoa($id_usuario){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario =:id");
            $cmd->bindValue(":id",$id_usuario);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;

        }

        public function atualizardados($id_usuario, $nome, $usuario, $telefone, $email){        
                $cmd = $this->pdo->prepare("UPDATE usuarios SET nome = :n, usuario = :u, telefone = :t, email = :e WHERE id_usuario = :id");
                $cmd->bindValue(":n",$nome);
                $cmd->bindValue(":u",$usuario);
                $cmd->bindValue(":t",$telefone);
                $cmd->bindValue(":e",$email);
                $cmd->bindValue(":id",$id_usuario);
                $cmd->execute();



        }
    }


?>