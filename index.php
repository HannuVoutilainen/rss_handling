<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>How to Parse XML with SimpleXML and PHP</title>
</head>
<body>
<?php
//$feed = file_get_contents('https://feeds.yle.fi/uutiset/v1/majorHeadlines/YLE_UUTISET.rss');
$url = ' https://feeds.yle.fi/uutiset/v1/recent.rss?publisherIds=YLE_UUTISET&concepts=18-34837';
$xml = simplexml_load_file($url) or die("Can't connect to URL");
//$xml = simplexml_load_strimg($feed) or die("Can't connect to URL");

?><pre><?php //print_r($xml); ?></pre><?php

foreach ($xml->channel->item as $item) {
    printf('<li><a href="%s">%s</a></li>', $item->link, $item->title);
}
?>  
</body>
</html>
