<?php

/**
 * Function to enhance print_r output
 * */
function d($obj): string {
    return highlight_string("<?php\n" . print_r($obj, true) . "\n", true);
}

// Connexion à la base
$dbh = new PDO( 'mysql:host=mysql-vulnerable;port=3306;dbname=sql_injection', 'sql_injection', 'sql_injection');
$mysqli = new mysqli("mysql-vulnerable", "sql_injection", "sql_injection", "sql_injection");

/**
 * Récupération des identifiants passés par le formulaire
 */
if ( isset($_POST['username']) && $_POST['username'] != '' )
{
    // Récupération des valeurs issues du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];



    // -----------------------------------------------
    // Requete vulnérable
    // -----------------------------------------------
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password';";
    // Exécution de la requête vulnérable
    $result = false;
    try{
        error_log("QUERY: " . $query);

        $mysqli->multi_query( $query );
        $sth = $mysqli->store_result();
        $results = $sth->fetch_all(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        $message = $e->getMessage();
    }
    // -----------------------------------------------

    // -----------------------------------------------
    // Requête préparée anonyme
    // -----------------------------------------------
//        $query = "SELECT * FROM users WHERE username=? AND password=?;";
//        // Exécution de la requête préparée anonyme
//        $results = false;
//        try{
//            $sth = $dbh->prepare( $query );
//
//            // Requêtes paramétrées avec des types
//            $sth->bindParam(1, $username, PDO::PARAM_STR);
//            $sth->bindParam(2, $password, PDO::PARAM_STR);
//
//            $sth->execute();
//            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
//        }
//        catch (PDOException $e)
//        {
//            $message = $e->getMessage();
//        }
    // -----------------------------------------------

    // -----------------------------------------------
    // Requete préparée nommée
    // -----------------------------------------------
//        $query = "SELECT * FROM users WHERE username=:username AND password=:password;";
//
//        // Exécution de la requête préparée nommée
//        $results = false;
//        try{
//            $sth = $dbh->prepare( $query );
//
//            // Requêtes paaramétrées avec des types
//            $sth->bindParam(':username', $username, PDO::PARAM_STR);
//            $sth->bindParam(':password', $password, PDO::PARAM_STR);
//
//            $sth->execute();
//            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
//        }
//        catch (PDOException $e)
//        {
//            $message = $e->getMessage();
//        }
    // -----------------------------------------------
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
            <i>Requête exécutée sur le serveur :</i>
            <br><br>
            <?php
                echo $query;
            ?>
        </p>
        <hr>
        <p>
            <?php
                if ( isset($results) && $results!==false ) {
                    // Ok
                    print_r("Login successful as user: <b>$username</b>");
                    print("<br/>");
                    print("<br/>");
                        echo d($results, true);
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