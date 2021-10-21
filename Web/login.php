<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: home.php");
} else {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = htmlentities($_POST["email"]);
        $password = htmlentities($_POST["password"]);
        $con = new mysqli("localhost", "root", "055510", "picewatch");
        if ($con->connect_error) {
            exit("Failed to read database");
        }
        $stmt = "SELECT password FROM user WHERE email = '" . $email . "';";
        if ($result = $con->query($stmt)) {
            $dbhash = $result->fetch_assoc();
            $hash = $dbhash["password"];
            if (password_verify($password, $hash)) {
                $stmt = "SELECT id FROM user WHERE email = '" . $email . "' AND password = '" . $password . "';";
                if ($result = $con->query($stmt)) {
                    $user = $result->fetch_assoc();
                    $_SESSION["id"] = $user["id"];
                    if(isset($_SESSION["url"])){
                        header("Location: addproduct.php");
                    }
                    header("Location: home.php");
                }
            } else {
                echo "E-Mail or Password incorrect";
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PriceWatch - Anmelden</title>
        <link rel="stylesheet" href="stylesheet.css"/>
    </head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label>E-Mail: </label>
            <input type="email" name="email">
            <label>Passwort: </label>
            <input type="password" name="password">
            <button type="submit">Anmelden</button>
        </form>
        <p>Noch kein Account? <a href="signin.php">Jetzt kostenlos registrieren</a></p>
        <?php
// put your code here
        ?>
    </body>
</html>
