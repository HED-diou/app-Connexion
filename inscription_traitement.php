<?php
require_once 'serveur.php';

$error = 1;
   
if(!preg_match('/^[a-zA-Z0-9_]+$/',$_POST['pseudo']) || empty($_POST['pseudo'])){
    $error = 2;
}

if(empty($_POST['email'] || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))){
    $error = 2;
}

if(empty($_POST['pass']) || $_POST['pass'] != $_POST['pass_retype'] ){
    $error = 2;
}
if($error == 2)
{
    header('Location: inscription.php?reg_err=syntax');
}   
            
if($error == 1)
{
    if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_retype']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['pass']);
        $pass_retype = htmlspecialchars($_POST['pass_retype']);

        $check = $bdd->prepare('SELECT * FROM clients where upper(pseudo) = upper(:pseudo) AND lower(email) = lower(:email)');
        $check->execute(array(':pseudo' => $pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 0)
        { 
            require 'functions.php'; //-------------------------FUNCTION
            $token = str_random(60);
            //$token = "temp";
            $avatar = "avatar/default.png";
            $ip = $_SERVER['REMOTE_ADDR'];
            $cost = ['cost' => 12];
            $pass = password_hash($pass, PASSWORD_BCRYPT, $cost);
            //$pass = hash('sha256',$pass);
            $insert = $bdd->prepare('INSERT INTO clients (id_client, pseudo, pass, email, ip ,confirmation_token, avatar) VALUES (NULL, :pseudo, :pass, :email, :ip , :token , :avatar)');
            
            //var_dump($token);
            //die();
            
            $insert->execute( array( 
                        ':pseudo' => $pseudo,
                        ':pass' => $pass,
                        ':email' => $email,
                        ':ip' => $ip,
                        ':token' => $token,
                        ':avatar' => $avatar
             ) );
            //$user_id = $bdd->lastInsertId();
            //mail($email,'Confirmation de votre compt', "A fin de valider votre compt , merci de cliker sur le lien \n \n http://localhost/php/confirm.php?id=$user_id&token=$token");

            header('Location:index.php?reg_err=success_reg');
            exit();
        }
        else
        {
            header('Location: inscription.php?reg_err=already');
        }
    }
}



?>