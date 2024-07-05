<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'string',
            'type' => 'string',
            'price' => 'numeric',
            'group_quantity' => 'integer',
            'group_weight' => 'numeric',
            'current_stock' => 'integer',
        ]);

        $item = Item::create($validated);

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return $this->apiResponse(null, 'Item not found', 404);
        }

        return response()->json($item, 200);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return $this->apiResponse(null, 'Item not found', 404);
        }

        $validated = $request->validate([
            'category' => 'sometimes|string',
            'type' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'group_quantity' => 'sometimes|integer',
            'group_weight' => 'sometimes|numeric',
            'current_stock' => 'required|integer',
        ]);

        $item->update($validated);

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return $this->apiResponse(null, 'Item not found', 404);
        }

        $item->delete();

        return response()->json(null, 204);
    }

    private function apiResponse($data, $message = null, $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }
}

