
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <title>Connexion</title>
        </head>
        <body>
        
        <div class="login-form">
             <?php 
                if(isset($_GET['login_err'])){      
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'success':
                            ?>
                                <div class="alert alert-success">
                                    <strong>success</strong> Connexion etablis
                                </div>
                            <?php
                            break;
                            case 'connexion':
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> Connexion obligatoire
                                    </div>
                                <?php
                                break;

                            case 'success_reg':
                                ?>
                                    <div class="alert alert-success">
                                        <strong>Succès</strong> inscription réussie !
                                    </div>
                                <?php
                            break;

                        case 'syntax':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe ou identifiant incorrect
                            </div>
                        <?php
                        break;


                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 
            
            <form action="connexion_traitement.php" method="post">
                <h2 class="text-center">Connexion</h2>       
                <div class="form-group">
                    <input type="text" name="user" class="form-control" placeholder="Email ou Pseudo" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                </div>   
            </form>
            <p class="text-center"><a href="inscription.php">Inscription</a></p>
        </div>
        <style>
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
        </body>
</html>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>



    <form action="" method="post">
    <input type="text" name="user" placeholder="pseudo ou email" required="">
    <input type="password" name="pass" placeholder="mot de passe" required=""> 
    
    <input type="submit" value="connexion">
    
    </form>
    pas de compte ?<a href="login.php">clické ici</a> :)
</body>
</html> -->