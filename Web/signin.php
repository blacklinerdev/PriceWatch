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
            exit("Failed to read sign in");
        }
        $passwordhash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $con->prepare("INSERT INTO user (email, password) VALUES (?,?);");
        $stmt->bind_param("ss", $email, $passwordhash);
        if ($stmt->execute()) {
            $stmt = "SELECT password FROM user WHERE email = '" . $email . "';";
            if ($result = $con->query($stmt)) {
                $dbhash = $result->fetch_assoc();
                $hash = $dbhash["password"];
                if (password_verify($password, $hash)) {
                    $stmt = "SELECT id FROM user WHERE email = '" . $email . "' AND password = '" . $password . "';";
                    if ($result = $con->query($stmt)) {
                        $user = $result->fetch_assoc();
                        $_SESSION["id"] = $user["id"];
                        header("Location: home.php");
                    }
                } else {
                    echo "E-Mail or Password incorrect";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrieren</title>
        <link rel="stylesheet" href="stylesheet.css"/>
    </head>
    <body>
        <h1>Registrieren</h1>
        <form action="signin.php" method="post">
            <label>E-Mail: </label>
            <input type="email" name="email">
            <label>Passwort: </label>
            <input type="password" name="password">
            <button type="submit">Registrieren</button>
        </form>
        <p>Du hast bereits ein Account? <a href="login.php">Anmelden</a></p>
    </body>
</html>