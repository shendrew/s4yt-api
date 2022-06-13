<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationService
{
    private static $client;

    public function __construct()
    {
        static::$client = Http::withoutVerifying()
        ->withHeaders([
            'X-CSCAPI-KEY' => config('cities_api.api_key'),
        ]);
    }

    public static function getCountries()
    {
        return static::$client->get(config('cities_api.base_url') . '/');
    }

    public static function getStates(string $ciso)
    {
        return static::$client->get(config('cities_api.base_url') . '/' . $ciso . '/states');
    }

    public static function getCities(string $ciso, string $siso)
    {
        return static::$client->get(config('cities_api.base_url') . '/' . $ciso . '/states' . '/' . $siso . '/cities');
    }

    public static function getCiso(string $userCountry, array $countries)
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
