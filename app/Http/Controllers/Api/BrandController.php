<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    private const CACHE_TIME = 300;
    private const CACHE_KEY = 'brands_all';

    public function __construct(protected BrandService $brandService) {}

    public function index(): JsonResponse
    {
        $brands = Cache::remember(self::CACHE_KEY, self::CACHE_TIME, function () {
            return $this->brandService->getAll();
        });

        return response()->json([
            'success' => true,
            'data' => $brands,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $brand = $this->brandService->getById($id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $brand,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $brand = $this->brandService->create($validated);

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $brand], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'country' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $brand = $this->brandService->update($id, $validated);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $brand]);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->brandService->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted'
        ]);
    }
}
