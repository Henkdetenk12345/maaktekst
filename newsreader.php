<?php
include "simple_html_dom.php";

$rssfeed = "https://feeds.nos.nl/nosnieuwsalgemeen";
$rawFeed = file_get_contents($rssfeed);
$xml = new SimpleXmlElement($rawFeed);
$count = 0;

foreach ($xml->channel->item as $item) {
    $title = (string)$item->title;
    $url   = (string)$item->link;

    // Sla podcasts, wekdiensten en liveblog-samenvattingen over
    if (stripos($title, 'podcast')   !== false) continue;
    if (stripos($title, 'wekdienst') !== false) continue;
    if (stripos($title, 'liveblog')  !== false) continue;

    // Haal de volledige pagina op
    $str = file_get_html($url);
    if (!$str) continue;

    // Sla audio/video-artikelen over via de uiteindelijke URL
    $tags = $str->find("link[rel=canonical]");
    if (empty($tags)) continue;
    preg_match('/href="https?:\/\/[^\/]+(\/[^"]+)"/', (string)$tags[0], $m);
    $path = isset($m[1]) ? $m[1] : '';
    if (strncmp($path, "/nieuws/av/", 11) === 0) continue;
    if (strncmp($path, "/video/",      7) === 0) continue;
    if (strncmp($path, "/audio/",      7) === 0) continue;

    echo $path . "\n";
    echo $title . "\n";
    file_put_contents("page$count.html", $str);   // Sla op als page<x>.html
    $count++;

    if ($count >= 20) break;
}
?>