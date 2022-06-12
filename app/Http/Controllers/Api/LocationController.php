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
    public function getCountries(LocationService $locationService): JsonResponse
    {
        $countries = Cache::remember('countries', 60*60*24*7, function() use ($locationService) {
            return ($locationService->getCountries())->json();
        });

        return $this->sendResponse(
            [
               'countries' => $countries
            ],
            "List of countries"
        );
    }

    public function getStates(StatesRequest $request, LocationService $locationService): JsonResponse
    {
        $validated = $request->validated();

        $states = Cache::remember('states_' . $validated['ciso'], 60*60*24*7, function() use ($locationService, $validated) {
            return ($locationService->getStates($validated['ciso']))->json();
        });

        return $this->sendResponse(
            [
                'country' =>  $validated['ciso'],
                'states' => $states
            ],
            "List of states by country"
        );
    }

    public function getCities(CitiesRequest $request, LocationService $locationService): JsonResponse
    {
        $validated = $request->validated();

        $cities = Cache::remember('cities_' . $validated['ciso'] . '_' . $validated['siso'], 60*60*24*7, function() use ($locationService, $validated) {
            return ($locationService->getCities($validated['ciso'], $validated['siso']))->json();
        });

        return $this->sendResponse(
            [
                'country' =>  $validated['ciso'],
                'state' => $validated['siso'],
                'cities' => $cities
            ],
            "List of cities by state and country"
        );
    }
}
