<?php

namespace App\Http\Controllers;

use App\Services\OpeningHoursService;

class OpeningHoursController extends Controller
{
    private $openingHoursService;

    public function __construct(OpeningHoursService $openingHoursService)
    {
        $this->openingHoursService = $openingHoursService;
    }
    public function getOpeningHours()
    {
        try {
            $data = $this->openingHoursService->getOpeningHoursData();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve opening hours data'], 500);
        }
    }
}
