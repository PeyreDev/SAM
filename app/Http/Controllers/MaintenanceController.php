<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipment = Equipment::where('id', session('equipment'))->first();

        return view('maintenances.create', compact('equipment'));
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
            'date'          => ['required'],
            'gravity'       => ['required'],
            'description'   => ['required'],
            'equipment_id'  => ['required'],
        ]);

        $maintenance = $request->all();

        Maintenance::create($maintenance);

        return redirect()->route('maintenances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance = Maintenance::where('id', $id)->first();
        $equipment = Equipment::where('id', $maintenance->equipment->id)->first();

        return view('maintenances.show', compact('maintenance', 'equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintenance = Maintenance::where('id', $id)->first();
        $equipment = Equipment::where('id', session('equipment'))->first();

        return view('maintenances.edit', compact('maintenance', 'equipment'));
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
            'date'          => ['required'],
            'gravity'       => ['required'],
            'description'   => ['required'],
            'equipment_id'  => ['required'],
        ]);

        $maintenance = $request->except(['_token', '_method']);

        Maintenance::where('id', $id)->update($maintenance);

        return redirect()->route('maintenances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Maintenance::where('id', $id)->delete();

        return redirect()->route('maintenances.index');
    }
}
