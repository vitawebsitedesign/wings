<?php
require_once('funcs/util/filterOutSymbolFileNames.php');
$listingDataDir = 'data/listings';
$fileNames = filterOutSymbolFileNames(scandir($listingDataDir));
$combinedDataFileName = 'combined.json';
$combinedDataFileNameLower = strtolower($combinedDataFileName);

$datas = [];
foreach ($fileNames as $fileName) {
	$fileNameLower = strtolower($fileName);
	if ($fileNameLower == $combinedDataFileNameLower) {
		continue;
	}

	$path = "$listingDataDir/$fileName";
	$jsonDataForPage = file_get_contents($path, true);
	$dataForPage = json_decode($jsonDataForPage);
	$datas[] = $dataForPage;
}

// Combine all arrays
$combinedData = [];
foreach ($datas as $data) {
	$combinedData = array_merge($combinedData, $data);
}

$json = json_encode($combinedData, JSON_UNESCAPED_SLASHES);
file_put_contents("$listingDataDir/$combinedDataFileName", $json);
