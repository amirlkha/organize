<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return response()->json($inventories);
    }
    public function store(Request $request)
    {
    
        $request->validate([
            'category' => 'required|string',
            'type' => 'required|string',
            'fur_type' => 'required|string',
            'fur_number' => 'required|integer',
            'weights_count' => 'required|integer',
            'weight' => 'required|integer'
        ]);


        $inventory = Inventory::create([
            'category' => $request->category,
            'type' => $request->type,
            'fur_type' => $request->fur_type,
            'fur_number' => $request->fur_number,
            'weights_count' => $request->weights_count,
            'weight' => $request->weight
        ]);

        return response()->json([
            'message' => 'information is done',
            'data' => $inventory
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $request->validate([
            'category' => 'required|string',
            'type' => 'required|string',
            'fur_type' => 'required|string',
            'fur_number' => 'required|integer',
            'weights_count' => 'required|integer',
            'weight' => 'required|integer'
        ]);

        $inventory->update($request->all());

        return response()->json($inventory);
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
