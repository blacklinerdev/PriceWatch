<?php
session_start();
if (!isset($_SESSION["id"])) {
    //header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home - Pricewatch</title>
        <link rel="stylesheet" href="stylesheet.css"/>
    </head>
    <body>
        <a href="logout.php">ausloggen</a>
        <form action="" method="post">
            <p>Hier kannst du deine E-Mail Benachrichtigungen einstellen</p>
            <label>Product</label>
            <select>
                <option value="a">A</option>
                <option value="b">B</option>
            </select>
            <label>Preis <= </label>
            <input type="number" name="dropunder">
            <button type="submit">Speichern</button>
        </form>
    </body>
</html>

