<?php   
    // Démarrage de la session 
    session_start();
    // Include de la base de données
    require_once '../../serveur.php';


    // Si la session n'existe pas 
    if(!isset($_SESSION['user']))
    {
        header('Location:../index.php');
        die();
    }


    // Si les variables existent 
    if(isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['new_password_retype'])){
        // XSS 
        $current_password = htmlspecialchars($_POST['current_password']);
        $new_password = htmlspecialchars($_POST['new_password']);
        $new_password_retype = htmlspecialchars($_POST['new_password_retype']);


        $check_password  = $bdd->prepare('SELECT pass FROM clients WHERE email = :email');
        $check_password->execute(array(
            ":email" => $_SESSION['email']
        ));
        $data_password = $check_password->fetch(PDO::FETCH_OBJ);

        if(password_verify($current_password, $data_password->pass))
        {
            if($new_password == $new_password_retype){

                $cost = ['cost' => 12];
                $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
                $update = $bdd->prepare('UPDATE clients SET pass = :pass WHERE email = :email');
                $update->execute(array(
                    ":pass" => $new_password,
                    ":email" => $_SESSION['email']
                ));
                header('Location: ../client.php?err=success_password');
                die();
            }
        }
        else{
            header('Location: ../client.php?err=current_password');
            die();
        }



    }



