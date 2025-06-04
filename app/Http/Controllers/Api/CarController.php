<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{

    private const CACHE_TIME = 300;

    private const CACHE_KEY = 'cars_all';
    public function __construct(protected CarService $carService){}

    public function index(): JsonResponse
    {
        $cars = Cache::remember(self::CACHE_KEY, self::CACHE_TIME, function () {
            return $this->carService->getAll();
        });

        return response()->json([
            'success' => true,
            'data' => $cars,
        ]);
    }

    public function show($id): JsonResponse
    {
        $car = $this->carService->getById($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $car
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'color' => 'nullable|string|max:50',
            'vin' => 'required|string|unique:cars,vin',
            'mileage' => 'nullable|integer',
            'brand_id' => 'required|exists:brands,id',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $car = $this->carService->create($validated);

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $car], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'model' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer',
            'color' => 'nullable|string|max:50',
            'vin' => "sometimes|required|string|unique:cars,vin,$id",
            'mileage' => 'nullable|integer',
            'brand_id' => 'sometimes|required|exists:brands,id',
            'owner_id' => 'sometimes|required|exists:owners,id',
        ]);

        $car = $this->carService->update($id, $validated);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $car]);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->carService->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json([
            'success' => true,
            'message' => 'Car deleted'
        ]);
    }
}
