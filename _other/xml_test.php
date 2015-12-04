<?php

function addRSS($dbh, $args) {

  if(file_exists($args['link'])) {

    $xml = simplexml_load_file($args['link']);

    $new_item = $xml->channel->addChild("item"); 

    $new_item->addChild("title", $args['title']);
    $new_item->addChild("description", $args['description']);
    $new_item->addChild("pubDate", $args['pubDate']);

    $rss_file = fopen($args['link'], "w");
    fwrite($rss_file, $xml->asXML);

    $result['xml'] = $xml->asXML;
    $result['error'] = "0";
    $result['message'] = "All gucci";

  }
  else {
    $result['error'] = "1";
    $result['message'] = "RSS File does not Exist";
  }

  return $result;
}

$args['user'] = "test";

$args['title'] = "hi";
$args['category'] = "hey";
$args['description'] = "desc";
$args['pubDate'] = date('Y/m/d');

$args['link'] = "_rss/_profiles/_".$args['user']."/rss_".$args['user'].".xml";

echo json_encode(addRSS($args));