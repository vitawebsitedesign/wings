<?php

runPipeline([
	'mine-html-pages.php',
	'generate-listing-data-from-html-pages.php',
	'combine-all-listing-data-into-one-file.php',
	'echo-html-with-links-to-filtered-listings.php'
]);

function runPipeline($filenames) {
	$pipelineDir = 'funcs/pipeline';
	foreach ($filenames as $fileName) {
		$path = "$pipelineDir/$fileName";
		require_once($path);
	}
}
