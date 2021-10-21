<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PriceWatch - Erstelle deine eigenen Angebote</title>
        <link rel="stylesheet" href="stylesheet.css"/>
    </head>
    <body>
        <p>Erstelle kostenlos deine eigenen Angebote</p>
        <p>
            Werde über alle Angebote der Produkte auf deiner persönlichen Liste benachrichtigt.<br>
            Verfolge den Preisverlauf deiner Produkte und kaufe zum besten Zeitpunkt.<br>
            Entledige dich unpersonalisierter Werbung und Spam und erhalte nur Angebote, die dich wirklich interessieren.<br>
            
        </p>
        <form action="addProduct.php" method="post">
            <label>Welches Produkt möchtest du auf deine persönliche Liste setzen ?</label>
            <input type="text" name="product_url">
            <button type="submit">Hinzufügen</button>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
