<?php

namespace App\Http\Controllers;
use App\Ship;

use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::all();
        return response()->json([
            "ships" => $ships
        ], 200);
    }
 
    public function get($id)
    {
        $ship = Ship::whereId($id)->first();

        return response()->json([
            "ship" => $ship
        ],200);
    }

    public function store(Request $request)
    {
        $ship = Ship::create($request->all());

        return response()->json([
            "ship" => $ship
        ], 201);
    }

    public function update(Request $request, Ship $ship)
    {
        $ship->update($request->all());

        return response()->json($ship, 200);
    }

    public function delete(Ship $ship)
    {
        $ship->delete();

        return response()->json(null, 204);
    }
}
