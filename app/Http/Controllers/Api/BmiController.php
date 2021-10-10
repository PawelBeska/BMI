<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateBmiRequest;
use App\Models\Bmi;
use App\Services\Bmi\BmiService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * @method successResponse(array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $__)
 * @method errorResponse(array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $__, int $HTTP_UNPROCESSABLE_ENTITY)
 */
class BmiController extends Controller
{


    public function addToHistory(CalculateBmiRequest $request, BmiService $bmiService)
    {
        $data = $request->validated();
        $bmi = $bmiService->addToHistory([
            'weight' => $data['weight'],
            'height' => $data['height'],
            'age' => $data['age'],
            'male' => $data['male'],
        ], $request->user());
        return $this->successResponse([
            'bmi' => $bmi->bmi,

        ]);
    }

    public function getHistoryData(Request $request)
    {
        return DataTables::of(Bmi::all())->make();
    }

    public function destroy(Bmi $bmi)
    {
        $bmi->delete();
        return $this->successResponse('Pomyślnie usunięto');
    }

}

