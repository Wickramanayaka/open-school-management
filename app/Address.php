<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use FullTextSearch;

    protected $fillable = [
        'address','latitude','longitude'
    ];

    protected $searchable = ['address'];

    // public function getFullAddressAttribute(){
    //     $address =  "{$this->home_number}, {$this->lane}, {$this->road}, {$this->town}, {$this->country}";
    //     // Remove patter ", ," from address
    //     $address = str_replace(", ,",",",$address);
    //     // Remove first "," when home no/name empty
    //     return ltrim($address,",");
    // }

    public function getMapFormatAttribute(){
        $address =  "{$this->address}";
        // Convert ',' to '+'
        $address = str_replace(",","+",$address);
        // Covert space to '+'
        $address = str_replace(" ","+",$address);
        return $address;
    }

    public function scopeDistance($query,$array)
    {
        return $query->selectRaw("*,(((acos(sin(( $array[0] *pi()/180)) * sin((`latitude`*pi()/180))+cos(($array[0] *pi()/180)) * cos((`latitude`*pi()/180)) * cos((($array[1] - `longitude`)*pi()/180))))*180/pi())*60*1.1515) as distance")->having('distance','<',$array[2]);
    }
}
