<?php
    // tietokantayhteyden avaus
    try {
        $yhteys = new PDO("mysql:host=localhost;dbname=rrs_handler", "rrs_handler", "");
    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    // tarkistetaan onko lomakkeella käyty
    if(isset($_POST['flag'])) {
        //if(isset($_POST['feed_name']) && isset($_POST['feed_url'])) {
        if($_POST['feed_name'] != "" && $_POST['feed_url'] != "") {
            echo "asetettu";
        } else {
            echo "Virallinen virhe, tietoja puuttuu";
        }
    }
    
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $yhteys->exec("SET NAMES latin1");
    $kysely = $yhteys->prepare("SELECT * FROM category");
    $kysely->execute();
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
            Uutisvirran kategoria:
            <select name="feed_category">
                <?php
                while ($rivi = $kysely->fetch()) {
                    echo "<option value='" . $rivi["categori_id"] . "'>" . 
                    $rivi["category_name"] . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="send" name="Lähetä">
        </form> 
    </body>
</html>