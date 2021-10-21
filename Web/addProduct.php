<?php
session_start();
if(!isset($_SESSION["id"])){
    if(isset($_POST["url"])){
        $_SESSION["url"] = htmlentities($_POST["url"]);
    }
    header('Location: login.php');
}
 else {
    $user_id = htmlentities($_SESSION["id"]);
    if(isset($_Post["url"])){
        $_SESSION["url"] = $_POST["url"];
    }
}
if (isset($_POST["url"])) {
    $url = htmlentities($_POST["url"]);
    $con = new mysqli("localhost", "root", "055510", "picewatch");
    if ($con->connect_error) {
        die("Failed to read database");
    }
    $stmt = $con->prepare("INSERT INTO product (url) VALUES (?);");
    $stmt->bind_param("s", $url);
    if ($stmt->execute()) {
        $added = true;
    } else {
        $added = false;
    }
    $getpid = "SELECT id FROM product WHERE url = '".$url."';";
    if($res = $con->query($getpid)){
        if($res->num_rows == 1){
            $product_id = $res->fetch_assoc()["id"];
        }
    }
    $upm = $con->prepare("INSERT INTO user_product_map (product_id, user_id) VALUES (?, ?);");
    $upm->bind_param("ii", $product_id,$user_id);
    $upm->execute();
}
?>
<!doctype html>
<html>
    <head>
        <title>Füge ein Product deiner Watchlist hinzu - Pricewatch</title>
    </head>
    <body>
        <p>Füge hier die URL von dem Produkt ein, das du deiner Watchlist hinzufügen möchtest.</p>
        <form action="addProduct.php" method="post">
            <label>Product-URL: </label>
            <input type="text" name="url">
            <button type="submit">Hinzufügen</button>
        </form>
        <?php
            if (isset($added)) {
                if ($added) {
                    echo "Super, du hast ein weiteres Produkt zu  deiner Watchlist hinzugefügt";
                } else {
                    echo "Das Produkt konnte deiner Watchlist leider nicht hinzugefügt werden. Versuche es später nochmal";
                }
            }
            ?>
    </body>
</html>