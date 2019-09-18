<html>
<head>
<style>
body {
    background-color: lightblue;
}
table {
  border-collapse: collapse;
}
table, td {
  border: 1px solid black;
}
td {
  width: 300px;
  height: 100px;
  padding: 15px;
  vertical-align: top;
  background-color: lightgreen;
}
div {
  text-align: justify;
  font-size: 14px;
}
a {
  text-decoration: none;
}
h1 {
    color: green;
}
td.outset {
    outline-style: outset;
    outline-color: green;
}
</style>
</head>
<body>
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
    $feed_url = $rivi["feed_url"];
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($feed_url);

    //Hae elementti "<channel>"
    $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
    $channel_title = $channel->getElementsByTagName('title')
    ->item(0)->childNodes->item(0)->nodeValue;
    $channel_link = $channel->getElementsByTagName('link')
    ->item(0)->childNodes->item(0)->nodeValue;
    $channel_desc = $channel->getElementsByTagName('description')
    ->item(0)->childNodes->item(0)->nodeValue;

    //"<channel>" elementin tulostus
    echo("<h1><a href='" . $channel_link
    . "'>" . $channel_title . "</a>");
    echo("<br>");
    echo($channel_desc . "</h1>");

    //get and output "<item>" elements
    $x=$xmlDoc->getElementsByTagName('item');
    $item_total = $x->length;
    echo ("<table>");
    echo ("<tr>");
    for ($i=0; $i<$item_total; $i++) {
    $item_title=$x->item($i)->getElementsByTagName('title')
    ->item(0)->childNodes->item(0)->nodeValue;
    $item_link=$x->item($i)->getElementsByTagName('link')
    ->item(0)->childNodes->item(0)->nodeValue;
    $item_desc=$x->item($i)->getElementsByTagName('description')
    ->item(0)->childNodes->item(0)->nodeValue;
    
    // yhden otsikon ja kuvauksen tulostus
    echo ("<td class='outset'><h3><a href='" . $item_link  . "'>" . $item_title . "</a></h3>");
    echo ("<div>" . $item_desc . "</div></td>");
    // rivin vaihto
    if($i & 1) {
        echo ("</tr><tr>");
    }

}
echo ("</tr>");
echo ("</table>");
    
}
?>
</body>
</html>