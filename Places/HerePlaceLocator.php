<?php

namespace MSB\LocatorBundle\Places;

/**
 * HerePlaceLocator searches for places into the Here Place API
 */
class HerePlaceLocator implements PlaceLocatorInterface
{
	private $appId;
	private $appCode;

	/**
	 * @param string $appId   The here app id
	 * @param string $appCode The here app code
	 */
    function __construct($appId, $appCode)
    {
        $this->appId = $appId;
        $this->appCode = $appCode;
    }

    public function searchByKeyword($query)
    {
		// url encode query
		$urlEncodedQuery = urlencode($query);
	
		// build query url
        $url = sprintf('http://places.cit.api.here.com/places/v1/discover/search?at=48.85031735791848,2.3450558593746678&app_id=%s&app_code=%s&q=%s', $this->appId, $this->appCode, $urlEncodedQuery);
		
		// fetch and decode url
		$json = json_decode(file_get_contents($url), true);
		
		// transform every results into [name, address, source]
		return array_map(function($result) {
				return [
					'name'    => $result['title'],
					'address' => str_replace('<br/>', ', ', $result['vicinity']),
					'source'  => 'Here',
				];
			}, $json['results']['items']);
    }
}
