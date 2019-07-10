<?php
function filterOutSymbolFileNames($fileNames) {
	$symbolFileNames = ['..', '.'];
	return array_diff($fileNames, $symbolFileNames);
}
