<?php

namespace MSB\LocatorBundle\Places;

interface PlaceLocatorInterface
{
    /**
     * Searches places given a query
     *
     * @param string $query
     *
     * @return array
     */
    public function searchByKeyword($query);
}
