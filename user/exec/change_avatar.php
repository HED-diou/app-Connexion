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

var_dump($_FILES['avatar_file']);//die();

if(isset($_FILES['avatar_file']) && !empty($_FILES['avatar_file']['name']))
{
    $tailleMax = 20000000;
    $extensionValide = array('jpg','jpeg','gif','png');
    if($_FILES['avatar_file']['size'] <= $tailleMax)
    {
        $extentionUpload = strtolower(substr(strrchr($_FILES['avatar_file']['name'],'.'),1));
        if( in_array($extentionUpload, $extensionValide) )
        {
            $chemin = "../avatar/".$_SESSION['id'].".".$extentionUpload;
            $deplacment = move_uploaded_file($_FILES['avatar_file']['tmp_name'],$chemin);
            if($deplacment)
            {
                $update = $bdd->prepare("UPDATE `clients` SET `avatar` = :avatar WHERE `clients`.`id_client` = :id");
                $update->execute(array(
                    ':avatar' => "avatar/".$_SESSION['id'].".".$extentionUpload,
                    ':id' => $_SESSION['id']
                ));
                var_dump($deplacment);
                $_SESSION['avatar'] = $data->avatar;;
                header('Location: ../client.php?err=success_avatar');
                die();
            }
            else
            {
                var_dump($deplacment);
                header('Location: ../client.php?err=current_avatar_uncoin');
                die();
            }
        }
        else
        {
            header('Location: ../client.php?err=current_avatar_extention');
                die();
        }
    }
    else
    {
        header('Location: ../client.php?err=current_avatar_size');
                die();
    }
}
else
{
    header('Location: ../client.php?err=current_avatar_uncoin');
    die();
}







?>