<?php
session_start();
require_once '../serveur.php';

if(!isset($_SESSION['user']))
        header('Location:../index.php?login_err=connexion');

$check = $bdd->prepare('SELECT * FROM public_chat ORDER BY date DESC');
$check->execute(array());
$data = $check->fetchAll(PDO::FETCH_OBJ);
$row = $check->rowCount();


$check2 = $bdd->prepare('SELECT * FROM clients');
$check2->execute(array());
$data2 = $check->fetchAll(PDO::FETCH_OBJ);
$row2 = $check->rowCount();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET['sup']))
    {
        $sup = htmlspecialchars($_GET['sup']);
        switch($sup)
        {
            case 'succes':
                echo "<div class='alert alert-success'>Le message a été suprimer avec success</div>";
                break;
            case 'error':
                echo "<div class='alert alert-danger'>error de la supression</div>";
                break;    
        }
    }
    
    
    ?>
    <br>
    <a href="client.php">profil</a> <br>
    <a href="deconnexion.php">Deconnexion</a>
    <br>
<table border="1">
<tr>
        <td>
            <img width="50px" src="<?php echo $_SESSION['avatar']?>">
        </td>
        <td>
            <form action="forum_traitement.php" method="post">
            <input type="text" name="message" placeholder="evoiyez un message publique">
            <input type="submit" value="envoyer">
            </form>
        </td>
    </tr>
<?php        
  
$v = 0;   
echo 'Nombre de message en temps reele'. $row;
foreach($data as $m)
{
    $v++;
    if($v < 100){
        echo "<tr>";
            echo "<td>";
                ?><img  width="50px" src="<?php echo $m->avatar?>" alt="avatar"><?php
            echo "</td>";
            echo "<td>";
                echo $m->nom_client;
            echo "</td>";
            echo "<td>";
                echo $m->msg;
            echo "</td>";
            echo "<td>";
                echo $m->date;
            echo "</td>";
            if($_SESSION['power']==1)
            {
                $link = "sup_public_msg.php?sup_msg=.$m->nom_client";
                echo "<td>";
               echo "<a href='sup_public_msg.php?id=$m->id_message'>suprimer</a>";
               echo "</td>";
            }
        echo "</tr>";}
    //foreach($data2 as $c)
    //{
        
        // $v++;
        // if($v < 3)
        // {
        //     $c1 = "$client1->id_client";
        //     $c2 = "$client2->id_client";
        //     if($c1 == $c2)
        //     {
                
        //     }
        // }
    //}
}





?>
        
    
</table>
    







</body>
</html>

