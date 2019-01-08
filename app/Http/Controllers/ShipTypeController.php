<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShipType;

class ShipTypeController extends Controller
{
    public function index()
    {
        $shipTypes = ShipType::all();
        return response()->json([
            "shipTypes" => $shipTypes
        ], 200);
    }
 
    public function show(ShipType $shipType)
    {
        return $shipType;
    }

    public function store(Request $request)
    {
        $shipType = ShipType::create($request->all());

        return response()->json($shipType, 201);
    }

    public function update(Request $request, ShipType $shipType)
    {
        $shipType->update($request->all());

        return response()->json($shipType, 200);
    }

    public function delete(ShipType $shipType)
    {
        $shipType->delete();

        return response()->json(null, 204);
    }
}
