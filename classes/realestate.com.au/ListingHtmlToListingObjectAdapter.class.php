<?php
class ListingHtmlToListingObjectAdapter {
	private $regexPrice = '/\$[0-9,]+(?=<\/span>)/';
	private $regexAddress = '/(?<=alt=")[0-9\/\sA-Za-z,-]+(?=")/';
	private $regexUrl = '/(?<=href="\/).+?(?=")/';

	function adapt($listingHtml) {
		preg_match($this->regexPrice, $listingHtml, $matchedPrice);
		preg_match($this->regexAddress, $listingHtml, $matchedAddress);
		preg_match($this->regexUrl, $listingHtml, $matchedUrl);

		$price = $this->tryGetDataFromListing($matchedPrice);
		$address = $this->tryGetDataFromListing($matchedAddress);
		$url = $this->tryGetDataFromListing($matchedUrl);

		require_once('classes/Listing.class.php');
		return new Listing($price, $address, $url);
	}

	private function tryGetDataFromListing($matchedData) {
		if (isset($matchedData[0])) {
			return $matchedData[0];
		}
		return null;
	}
}
