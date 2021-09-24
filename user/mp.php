<?php
session_start();
require_once '../serveur.php';

if(!isset($_SESSION['user']))
         header('Location:../index.php?login_err=connexion');
if(isset($_POST['mp_envoi']))
{
    if(isset($_POST['mp_msg'],$_POST['destinataire']) AND !empty($_POST['mp_msg']) AND !empty($_POST['destinataire']))
    {
        $destinataire = htmlspecialchars($_POST['destinataire']);
        $mp = htmlspecialchars($_POST['mp_msg']);

        $check = $bdd->prepare('SELECT id_client FROM clients WHERE pseudo = ?');
        $check->execute(array($destinataire));
        $id_destinataire = $check->fetch(PDO::FETCH_OBJ);
        $id_destinataire = $id_destinataire->id_client;

        $ins = $bdd->prepare('INSERT INTO msgp(id_epediteur, id_destinataire,mp) VALUES(?,?,?)');
        $ins->execute(array($_SESSION['id'],$id_destinataire,$mp));
    }
}

$destinataire = $bdd->query('SELECT pseudo FROM clients ORDER BY pseudo');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="client.php">profil</a> <br>
<a href="reception.php">reception</a> <br>
    <a href="deconnexion.php">Deconnexion</a>

    <form action="" method="post">

<label>Destinataire : </label>
<select name="destinataire">
    <?php while($d = $destinataire->fetch(PDO::FETCH_OBJ)){ ?>
    <option><?php echo $d->pseudo ?></option>
    <?php } ?>
</select>
<br>
<br>
<textarea name="mp_msg" placeholder="envoyer votre message"></textarea>
<br><br>
<input type="submit" value="Envoyer" name="mp_envoi">


    </form>
</body>
</html>