<?php
session_start();
require_once 'serveur.php';

if(isset($_POST)){
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = htmlspecialchars($_POST['user']);
        $pass = htmlspecialchars($_POST['pass']);


        $check = $bdd->prepare('SELECT * FROM clients WHERE lower(email) = lower(:user) OR lower(pseudo) = lower(:user)');
        $check->execute(array(':user' => $user));
        $data = $check->fetch(PDO::FETCH_OBJ);
        $row = $check->rowCount();

        if($row == 1)
        {
           //$cost = ['cost' => 12];
           //$pass = password_hash($pass, PASSWORD_BCRYPT, $cost);
           var_dump($pass);
           var_dump($data->pass);
                $v = 2;
                
                
            if(password_verify($pass, $data->pass) ) {
                $_SESSION['user'] = $data->pseudo;
                $_SESSION['email'] = $data->email;
                $_SESSION['id'] = $data->id_client;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['avatar'] = $data->avatar;
                $_SESSION['power'] = $data->pawer;
                //var_dump($_SESSION['user']);
                //die();
                //echo '<div class="alert alert-success"><strong>validé</strong> veillez remplire tout les champ</div>';
                //header('location: index.php?login_err=success');die();
                header('location: user/client.php');die();
                //header('location: test.php');die();
            }
            else
            { 
                header('Location: index.php?login_err=syntax'); die(); 
            } 
        }
        else
        { 
            header('location: index.php?login_err=already');die(); 
        } 
    }

}
?>