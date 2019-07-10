<?php

require_once('classes/realestate.com.au/PageToListingsAdapter.class.php');
require_once('funcs/util/filterOutSymbolFileNames.php');
$adapter = new PageToListingsAdapter();

$htmlPagesDir = 'data/html/';
$listingDataDir = 'data/listings';
$htmlPageFileNames = filterOutSymbolFileNames(scandir($htmlPagesDir));

foreach ($htmlPageFileNames as $htmlPageFileName) {
	$path = "$htmlPagesDir/$htmlPageFileName";
	$htmlPage = file_get_contents($path);
	$listings = $adapter->adapt($htmlPage);

	$json = json_encode($listings, JSON_UNESCAPED_SLASHES);
	$listingsDataPath = "$listingDataDir/$htmlPageFileName.json";
	file_put_contents($listingsDataPath, $json);
}
