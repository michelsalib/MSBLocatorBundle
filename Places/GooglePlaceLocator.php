<?php

namespace MSB\LocatorBundle\Places;

/**
 * GooglePlaceLocator searches for places into the Google Place API
 */
class GooglePlaceLocator implements PlaceLocatorInterface
{
	private $key;

	/**
	 * @param string $key The google API key
	 */
    function __construct($key)
    {
        $this->key = $key;
    }

    public function searchByKeyword($query)
    {
		// url encode query
		$urlEncodedQuery = urlencode($query);

		// build query url
        $url = sprintf('https://maps.googleapis.com/maps/api/place/textsearch/json?sensor=true&key=%s&query=%s', $this->key, $urlEncodedQuery);

		// fetch and decode url
		$json = json_decode(file_get_contents($url), true);

		// transform every results into [name, address, source]
		return array_map(function($result) {
				return [
					'name'    => $result['name'],
					'address' => $result['formatted_address'],
					'source'  => 'Google',
				];
			}, $json['results']);
    }
}
