<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DockSlots;

class DockSlotController extends Controller
{
    public function index()
    {
        return DockSlots::all();
    }
 
    public function show(DockSlots $dockSlot)
    {
        return $dockSlot;
    }

    public function store(Request $request)
    {
        $dockSlot = DockSlots::create($request->all());

        return response()->json($dockSlot, 201);
    }

    public function update(Request $request, DockSlots $dockSlot)
    {
        $dockSlot->update($request->all());

        return response()->json($dockSlot, 200);
    }

    public function delete(DockSlots $dockSlot)
    {
        $dockSlot->delete();

        return response()->json(null, 204);
    }
}
