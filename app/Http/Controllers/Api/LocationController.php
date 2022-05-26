<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatesRequest;
use App\Http\Requests\CitiesRequest;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{

    const CITIES_API_URL = 'https://api.countrystatecity.in/v1/countries';

    public function getCountries(LocationService $locationService): JsonResponse
    {
        $countries = $locationService->getCountries();

        return $this->sendResponse(
            [
               'countries' => $countries->json()
            ],
            "List of countries"
        );
    }

    public function getStates(StatesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $states = Http::withoutVerifying()
            ->withHeaders([
                'X-CSCAPI-KEY' => config('cities_api.api_key'),
            ])->get(self::CITIES_API_URL . '/' . $validated['ciso'] . '/states');

        return $this->sendResponse(
            [
                'country' =>  $validated['ciso'],
                'states' => $states->json()
            ],
            "List of states of country"
        );
    }

    public function getCities(CitiesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $cities = Http::withoutVerifying()
            ->withHeaders([
                'X-CSCAPI-KEY' => config('cities_api.api_key'),
            ])->get(self::CITIES_API_URL . '/' . $validated['ciso'] . '/states' . '/' . $validated['siso'] . '/cities');

        return $this->sendResponse(
            [
                'country' =>  $validated['ciso'],
                'state' => $validated['siso'],
                'cities' => $cities->json()
            ],
            "List of cities of state of country"
        );
    }
}
