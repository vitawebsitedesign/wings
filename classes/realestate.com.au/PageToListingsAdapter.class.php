<?php
class PageToListingsAdapter {
	function adapt($listingPageHtml) {
		$regexListing = '/<article(.*?)results-card(.*?)>[\w\W]+?<\/article>/';
		preg_match_all($regexListing, $listingPageHtml, $matchedListings);
		$listings = $matchedListings[0];

		$listingsData = [];
		require_once('ListingHtmlToListingObjectAdapter.class.php');
		$adapter = new ListingHtmlToListingObjectAdapter();
		foreach ($listings as $listingHtml) {
			$listingsData[] = $adapter->adapt($listingHtml);
		}

		return $listingsData;
	}
}
