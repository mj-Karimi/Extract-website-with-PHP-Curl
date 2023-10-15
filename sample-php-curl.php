<?php 
 
// Web page URL 
$url = 'https://domain.com/'; 
 
// Extract HTML using curl 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
 
$data = curl_exec($ch); 
curl_close($ch); 
 
// Load HTML to DOM object 
$dom = new DOMDocument(); 
@$dom->loadHTML($data); 
 
// Parse DOM to get Title data 
$nodes = $dom->getElementsByTagName('title'); 
$title = $nodes->item(0)->nodeValue; 
 
// Parse DOM to get meta data 
$metas = $dom->getElementsByTagName('meta'); 
 
$description = $keywords = ''; 
for($i=0; $i<$metas->length; $i++){ 
    $meta = $metas->item($i); 
     
    if($meta->getAttribute('property') == 'og:image'){ 
        $description = $meta->getAttribute('content'); 
    } 
     
    if($meta->getAttribute('name') == 'keywords'){ 
        $keywords = $meta->getAttribute('content'); 
    } 
} 
 
echo "Title: $title". '<br/>'; 
echo "Description: $description". '<br/>'; 
echo "Keywords: $keywords"; 



 
$doc = new DOMDocument();
$doc->loadHTMLFile($url);

$xpath = new DOMXpath($doc);

// example 1: for everything with an id
$elements = $xpath->query("//h1");

// example 2: for node data in a selected id
//$elements = $xpath->query("/html/body/div[@id='yourTagIdHere']");

// example 3: same as above with wildcard
//$elements = $xpath->query("*/div[@id='yourTagIdHere']");

if (!is_null($elements)) {
  foreach ($elements as $element) {
    echo "<br/>[". $element->nodeName. "]";

    $nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo $node->nodeValue. "\n";
    }
  }
}



?>
