<?php
    // tarkistetaan onko lomakkeella käyty
    if(isset($_POST['flag'])) {
        //if(isset($_POST['feed_name']) && isset($_POST['feed_url'])) {
        if($_POST['feed_name'] != "" && $_POST['feed_url'] != "") {
            echo "asetettu";
            echo ":)";
        } else {
            echo "Virallinen virhe, tietoja puuttuu";
        }
    }
    // tietokantayhteyden avaus
    /*
    try {
        $yhteys = new PDO("mysql:host=localhost;dbname=rrs_handler", "rrs_handler", "");
    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    */
?>
<html>
    <head>
    </head>
    <body>
       <h2>Uutisvirran lisäys</h2>
        <form method="post" action="add_feed.php">
            <input type="hidden" name="flag" value="1">
            Uutisvirran nimi: <input type="text" name="feed_name" value="">
            Uutisvirran osoite: <input type="text" name="feed_url" value="">
            <input type="submit" name="send" name="Lähetä">
        </form> 
    </body>
</html>