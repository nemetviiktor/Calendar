<?php

namespace App\Http\Controllers;

use App\Models\OpeningHours;
use App\Helpers\OpeningHoursUtility;
use App\Services\OpeningHoursService;

class OpeningHoursController extends Controller
{
    public function getOpeningHours()
    {
        $openingHoursService = new OpeningHoursService();
        $data = $openingHoursService->getOpeningHoursData();
        return response()->json($data);
    }
}
