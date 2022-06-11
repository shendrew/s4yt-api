<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationService
{
    const CITIES_API_URL = 'https://api.countrystatecity.in/v1/countries';

    public function getCountries()
    {
        return Http::withoutVerifying()
            ->withHeaders([
                'X-CSCAPI-KEY' => config('cities_api.api_key'),
            ])->get(self::CITIES_API_URL . '/');
    }

    public function getCiso(string $userCountry, array $countries)
    {
        $ciso = null;
        foreach($countries as $country) {
            if($country['name'] == $userCountry) {
                $ciso = $country['iso2'];
            }
        }
        return $ciso;
    }
}
