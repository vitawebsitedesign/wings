<?php
$html = file_get_contents('templates/show-links-to-filtered-listings.htm');
$jsonStr = file_get_contents('data/listings/combined.json');
$htmlWithJson = str_replace('$JSON_PLACEHOLDER', $jsonStr, $html);
echo $htmlWithJson;
