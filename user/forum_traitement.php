<?php
session_start();
require_once '../serveur.php';
if(!isset($_SESSION['user']))
header('Location:../index.php?login_err=connexion');


var_dump($_POST['message']);
var_dump($_SESSION['id']);
var_dump($_SESSION['user']);


if(isset($_POST['message']))
{
    
    $id_client = $_SESSION['id'];
    //var_dump($_SESSION['id']);die();
    $nom_client = $_SESSION['user'];
    $avatar = $_SESSION['avatar'];
    $message = htmlspecialchars($_POST['message']);
    if(strlen($message) <= 255){
    $id_message = null;$date=null;
        $insert = $bdd->prepare("INSERT INTO `public_chat` (`id_message`, `id_client`, `nom_client`, `msg` , `avatar`) VALUES (NULL, :id_client, :nom_client, :msg ,:avatar )");
        $insert->execute(array(
            ':id_client' => $id_client,
            ':nom_client' => $nom_client,
            ':msg' => $message,
            ':avatar' => $avatar
        ));
        header('Location: forum.php');
        die();
    }
    
}




?>