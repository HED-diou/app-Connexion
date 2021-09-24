<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=location','root','');
    //$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);
    //$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(Exeption $e)
{
 die('Ereur' . $e ->getMessage());
}


?>