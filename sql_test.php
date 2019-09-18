<?php
try {
    $yhteys = new PDO("mysql:host=localhost;dbname=rrs_handler", "rrs_handler", "");
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$yhteys->exec("SET NAMES latin1");
$kysely = $yhteys->prepare("SELECT * FROM feed");
$kysely->execute();
while ($rivi = $kysely->fetch()) {
    $feed_id = $rivi["feed_id"];
    $feed_name = $rivi["feed_name"];
    $feed_url = $rivi["feed_url"];
    echo $feed_id . "<br>";
    echo $feed_name . "<br>";
    echo $feed_url . "<br>";
}
?>