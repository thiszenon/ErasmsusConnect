<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="jo_kabonga" content="" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>login</title>
</head>

<body>

    <div class="login-form">
        <?php
        //GESTION D'ERREUR LORS DE LA CONNEXION
        if (isset($_GET['login_error'])) {
            $error = htmlspecialchars($_GET['login_error']);
            switch ($error) {
                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe incorrect
                    <?php
                    break;

                case 'email':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email incorrect
                        </div>
                    <?php
                    break;
                case 'exist':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> utilisateur inexistant
                        </div>
            <?php
                    break;
            }
        }
            ?>


            <form action="login.php" method="post">
                <h2 class="text-center">Connexion</h2>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                </div>
            </form>
            <p class="text-center"><a href="registration.php">Inscription</a></p>
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

                        .form-control,
                        .btn {
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