<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Tag;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::all();
        $tags = Tag::where('tagcat_id', 3)->get(); //tagcat 3 => Equipment type

        return view('equipments.index', compact('equipments', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipmentTypes = Tag::where('tagcat_id', 3)->get();

        return view('equipments.create', compact('equipmentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier'          => ['required'],
            'model'             => ['required'],
            'serial'            => ['nullable'],
            'out_date'          => ['nullable'],
            'equipment_type'    => ['required', 'numeric'],
        ]);

        $equipment = $request->except(['_token', '_method']);
        Equipment::create($equipment);

        return redirect()->route('equipments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::where('id', $id)->first();
        $tagEquipType = Tag::where('id', $equipment->equipment_type)->first();

        return view('equipments.show', compact('equipment', 'tagEquipType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::where('id', $id)->first();
        $equipmentTypes = Tag::where('tagcat_id', 3)->get(); //tagcat_id : 3 => equipment type

        return view('equipments.edit', compact('equipment', 'equipmentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier'          => ['required'],
            'model'             => ['required'],
            'serial'            => ['nullable'],
            'out_date'          => ['nullable'],
            'equipment_type'    => ['required', 'numeric'],
        ]);

        $equipment = $request->except(['_token', '_method']);
        Equipment::where('id', $id)->update($equipment);

        return redirect()->route('equipments.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::where('id', $id)->delete();

        return redirect()->route('equipments.index');
    }
}
