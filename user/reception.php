<?php
session_start();
require_once '../serveur.php';
if(!isset($_SESSION['user']))
header('Location:../index.php?login_err=connexion');

?>
<a href="client.php">profil</a> <br>
<a href="mp.php">message privé</a><br>
    <a href="deconnexion.php">Deconnexion</a><br><br>
<?php

$check = $bdd->prepare('SELECT mp,id_epediteur FROM msgp WHERE id_destinataire = ?');
$check->execute(array($_SESSION['id']));
$data = $check->fetchAll(PDO::FETCH_OBJ);

$check2 = $bdd->prepare('SELECT id_client,pseudo FROM clients');
$check2->execute(array());
$data2 = $check2->fetchAll(PDO::FETCH_OBJ);

foreach($data as $m)
{
    foreach($data2 as $c)
    {   
        $c1 = $m->id_epediteur;
        $c2 = $c->id_client;
        
        if( $c1 == $c2 )
            echo ">" . $c->pseudo ." : " . $m->mp;?><br><?php
    }   
}  















?>