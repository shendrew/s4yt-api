<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationService
{
    const CITIES_API_URL = 'https://api.countrystatecity.in/v1/countries';

    public function getCountries()
    {
        return Cache::remember('get-countries', 60*60*24*7, function() {
            return  Http::withoutVerifying()
                ->withHeaders([
                    'X-CSCAPI-KEY' => config('cities_api.api_key'),
                ])->get(self::CITIES_API_URL . '/');
        });
    }
}
