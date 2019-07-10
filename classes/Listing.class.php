<?php
class Listing implements JsonSerializable {
	private $price;
	private $address;
	private $url;

	function __construct($price, $address, $url) {
		$this->price = $price;
		$this->address = $address;
		$this->url = $url;
	}	

	function jsonSerialize() {
		return get_object_vars($this);
	}
}
