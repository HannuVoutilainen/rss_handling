<?php
//GET uutisvirran tunniste muuttujaan q
$q=$_GET["q"];


//valitun syötteen osoite
if($q=="Yle_main") {
  $xml=("https://feeds.yle.fi/uutiset/v1/majorHeadlines/YLE_UUTISET.rss");
} elseif($q=="HS") {
  $xml=("https://www.hs.fi/rss/teasers/etusivu.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

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
  echo ("<td><h3><a href='" . $item_link  . "'>" . $item_title . "</a></h3>");
  echo ("<div>" . $item_desc . "</div></td>");
  // rivin vaihto
  if($i & 1) {
    echo ("</tr><tr>");
  }

}
echo ("</tr>");
echo ("</table>");
?>