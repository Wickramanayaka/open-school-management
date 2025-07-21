<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Map{

    private $apikey;
    private $address;

    public function _construct(){
        $this->apikey = env('GOOGLE_API_KEY','');
    }
    /**
     * Check for the Internet and if the Internet is not available
     * Return latLng (0,0) back to calling method
     */
    public function checkInternet()
    {
        $connected = @fsockopen("www.google.com",80);
        if($connected){
            return true;
        }
        return false;
    }

    public function getLatLng(Address $address){
        try{
            // Check for the Internet before convert address to GEOCode
            if($this->checkInternet()){

                $this->address = $address->address;

                $client = new Client();
                $data = $client->get("https://maps.googleapis.com/maps/api/geocode/json?address=" .$this->address . "&key=" . $this->apikey,['verify'=> false]);
                $content = json_decode((string) $data->getBody(),true);
                //return $content;
                if(is_array($content) && !array_key_exists('error_message',$content) && isset($content['results'][0])){
                    return [
                        'lat' => $content['results'][0]['geometry']['location']['lat'],
                        'lng' => $content['results'][0]['geometry']['location']['lng'],
                        'formatted_address' => $content['results'][0]['formatted_address']
                    ];
                }
                else{
                    // The function will run until data gets
                    //return $this->getLatLng($address);
                    return [
                        'lat' => 0,
                        'lng' => 0,
                        'formatted_address' => 0
                    ];
                }

            }
            else{

                return [
                    'lat' => 0,
                    'lng' => 0,
                    'formatted_address' => 0
                ];
            }

        }
        catch(Exception $e){
            return [
                'lat' => 0,
                'lng' => 0,
                'formatted_address' => 0
            ];
        }
    }
}