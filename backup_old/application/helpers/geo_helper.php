<?php

class Geolocation{



    private $route, $locality, $sublocality, $city, $country, $address;

    private $political, $administrative_area_level_2, $administrative_area_level_1, $postal_code;

    private $latlng;

    public function __construct($lat = '', $lng = ''){

        $this -> address = $this -> city = $this -> route = $this -> country = $this -> locality = $this -> sublocality = $this -> political = $this -> administrative_area_level_1 = $this -> administrative_area_level_2 = $this -> postal_code = '';

        if($lat <> ''){

            $this -> setLatLng($lat, $lng);

        }

    }



    public function setLatLng($lat, $lng){

        $this -> latlng = new LatLng($lat, $lng);

        return $this;

    }



    public function execute(){

        $lat_lng = $this -> latlng -> lat . ',' . $this -> latlng -> lng;

        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat_lng."&sensor=false";

        $json = file_get_contents($url);

        $data = json_decode($json, TRUE);

        if($data['status'] == "OK"){

            $this -> address = $data['results'][0]['formatted_address'];

            $data = $data['results'][0]['address_components'];

            if(is_array($data) && count($data) > 0){

                foreach($data as $js_row){

                    $types = $js_row['types'];

                    $type = $types[0];

                    $this -> $type = $js_row['long_name'];

                }

            }

        }

        return $this;

    }



    function getRoute(){return $this -> route;}

    function getLocation(){return $this -> locality;}

    function getCity(){return $this -> city;}

    function getState(){return $this -> administrative_area_level_1;}

    function getCapital(){return $this -> administrative_area_level_2;}

    function getCountry(){return $this -> country;}

    function getAddress(){return $this -> address;}

    function getPincode(){return $this -> postal_code;}

    function getArea(){return $this -> political;}

}





class LatLng{

    public $lat, $lng;

    function __construct($lat = '', $lng = ''){

        $this -> lat = $lat;

        $this -> lng = $lng;

    }

    function setLat($lat){ $this -> lat = $lat;}

    function setLng($lng){ $this -> lng = $lng;}

    function getLat(){return $this -> lat;}

    function getLng(){return $this -> lng;}

}