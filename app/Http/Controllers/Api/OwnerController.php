<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OwnerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OwnerController extends Controller
{
    private const CACHE_TIME = 300;
    private const CACHE_KEY = 'owners_all';

    public function __construct(protected OwnerService $ownerService) {}

    public function index(): JsonResponse
    {
        $owners = Cache::remember(self::CACHE_KEY, self::CACHE_TIME, function () {
            return $this->ownerService->getAll();
        });

        return response()->json([
            'success' => true,
            'data' => $owners,
        ]);
    }

    public function show($id): JsonResponse
    {
        $owner = $this->ownerService->getById($id);

        if (!$owner) {
            return response()->json([
                'success' => false,
                'message' => 'Owner not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $owner,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
        ]);

        $owner = $this->ownerService->create($validated);

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $owner], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'firstname' => 'sometimes|required|string|max:255',
            'lastname' => 'sometimes|required|string|max:255',
            'email' => "sometimes|required|email|unique:owners,email,$id",
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
        ]);

        $owner = $this->ownerService->update($id, $validated);

        if (!$owner) {
            return response()->json([
                'success' => false,
                'message' => 'Owner not found',
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json(['success' => true, 'data' => $owner]);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->ownerService->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Owner not found',
            ], 404);
        }

        Cache::forget(self::CACHE_KEY);

        return response()->json([
            'success' => true,
            'message' => 'Owner deleted',
        ]);
    }
}
