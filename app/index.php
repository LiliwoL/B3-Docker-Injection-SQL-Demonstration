<?php

// Connexion à la base
$dbh = new PDO( 'mysql:host=mysql-vulnerable;port=3306;dbname=sql_injection', 'sql_injection', 'sql_injection');

/**
 * Récupération des identifiants passés par le formulaire
 */
if ( isset($_POST['username']) && $_POST['username'] != '' )
{
    // Récupération des valeurs issues du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requete vulnérable
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password';";

    // Exécution de la requête
    $result = false;
    try{
        $sth = $dbh->prepare( $query );

        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        $message = $e->getMessage();
    }    
}else{
    $query = $message = '';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Login Form</title>

    <link href="style.css" rel="stylesheet"/>
</head>
<body>
<div id="login-form-wrap">
    <h2>Login</h2>
    <form id="login-form" method="POST">
        <p>
            <input type="text" id="username" name="username" placeholder="Username">
            <i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="password" id="password" name="password" placeholder="Password">
            <i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="submit" id="login" value="Login">
        </p>
    </form>
    <div id="create-account-wrap">
        <p>
            <?php
                echo $query;
            ?>
        </p>
        <p>
            <?php
                if ( isset($result) && $result!==false ) {
                    // Ok
                    print_r("Login successful as user: $username");
                    print("<br/>");
                    print("<br/>");
                    var_dump($result);
                } else {
                    if ( isset($error) ) {
                        // Error
                        print_r("Error \n");
                        print_r( $message );
                    }
                }
            ?>
        </p>
    </div>
</div>
</body>
</html>