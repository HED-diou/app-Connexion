<?php
session_start();
require_once '../serveur.php';
     if(!isset($_SESSION['user']))
        header('Location:../index.php?login_err=connexion');

if(isset($_GET['id'])){
$id_sup = htmlspecialchars($_GET['id']);

$supp = $bdd->prepare('DELETE FROM public_chat WHERE id_message = ?');
$supp->execute(array($id_sup ));
header('Location: forum.php?sup=succes');
die();
}
?>