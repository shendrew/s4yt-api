<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{

    const CITIES_API_URL = 'https://api.countrystatecity.in/v1/countries';

    public function getCountries(Request $request): JsonResponse
    {
        $countries = Http::withoutVerifying()
        ->withHeaders([
            'X-CSCAPI-KEY' => config('cities_api.api_key'),
        ])->get(self::CITIES_API_URL . '/');

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
                'countries' => $states->json()
            ],
            "List of states"
        );
    }
}
