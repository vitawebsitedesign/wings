<?php
class PageMiner {
	private $dataDir;
	private $ch;

	function __construct($dataDir) {
		$this->dataDir = $dataDir;

		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
	}

	function __destruct() {
		curl_close($this->ch);
	}

	function mine($suburb, $numPages) {
		for ($page = 1; $page < $numPages + 1; $page++) {
			$this->minePage($suburb, $page);
		}
	}

	private function minePage($suburb, $page) {
		$dataFilePath = $this->getDataFilePath($suburb, $page);
		$html = $this->getHtmlForSuburbAndPage($suburb, $page);
		file_put_contents($dataFilePath, $html);
	}

	private function getDataFilePath($suburb, $page) {
		$dataDir = $this->dataDir;
		return "$dataDir/$suburb-$page.htm";
	}

	private function getHtmlForSuburbAndPage($suburb, $page) {
		$url = $this->getUrlForSuburbAndPage($suburb, $page);
		curl_setopt($this->ch, CURLOPT_URL, $url);
		return curl_exec($this->ch);
	}

	private function getUrlForSuburbAndPage($suburb, $page) {
		return "https://www.realestate.com.au/buy/in-$suburb/list-$page?activeSort=price-asc";
	}
}




