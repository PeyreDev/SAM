<?php

namespace App\Http\Controllers;

use App\Models\Cvr;
use App\Models\Cvr_step;
use App\Models\Equipment;
use App\Models\Gas_flow;
use App\Models\Sample;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CvrStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cvr_steps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cvrStep = Cvr_step::where('id', $id)->first();
        $cvr = Cvr::where('id', $cvrStep->cvr_id)->first();
        $equipments = Equipment::all();
        $tag = $cvr->tags()->first();

        $sampleId = session('sampleId');
        $sample = Sample::where('id', $sampleId)->first();

        $gasFlows = Gas_flow::where('cvr_step_id', $id)->get();

        return view('cvr_steps.show', compact('cvr', 'equipments', 'sample', 'cvrStep', 'tag', 'gasFlows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cvrStep = Cvr_step::where('id', $id)->first();
        $cvr = Cvr::where('id', $cvrStep->cvr_id)->first();
        $equipments = Equipment::all();
        $tagsCvr = Tag::where('tagcat_id', 2)->get(); // tagcat_id : 2 => Process type
        $tagsMaterial = Tag::where('tagcat_id', 1)->get(); // tagcat_id : 1 => Material
        $relatedTagCvr = $cvr->tags()->first(); // for preselection of process type
        $relatedTagMaterial = $cvrStep->tags()->first(); // for preselection of material

        return view('cvr_steps.edit', compact('cvrStep', 'cvr', 'equipments', 'tagsCvr', 'relatedTagCvr', 'tagsMaterial', 'relatedTagMaterial'));
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
            'recipe_name'            => ['nullable'],
            'position'               => ['nullable'],
            'equipment_id'           => ['required'],
            'comment'                => ['nullable', 'string'],
            'motivation'             => ['nullable', 'string'],
            'pressure'               => ['required'],
            'duration'               => ['required'],
            'temperature_initial'    => ['required'],
            'temperature_final'      => ['nullable'],
            'material'               => ['nullable'],
        ]);

        $cvrStep = $request->except(['_token', '_method', 'recipe_name', 'position', 'equipment_id', 'comment', 'motivation', 'process_type', 'material']);
        Cvr_step::where('id', $id)->update($cvrStep);

        $cvrStep = Cvr_step::where('id', $id)->first();

        $cvr = $request->except(['_token', '_method', 'process_type', 'pressure', 'duration', 'temperature_initial', 'temperature_final', 'material']);
        Cvr::where('id', $cvrStep->cvr_id)->update($cvr);


        //we update the taggable table
        $processTypeId = $request->input('process_type');
        $materialId = $request->input('material');

        DB::update("UPDATE taggables SET tag_id = ? WHERE taggable_type = ? AND taggable_id = ?", [$materialId, 'App\Models\Cvr_step', $id]);
        DB::update("UPDATE taggables SET tag_id = ? WHERE taggable_type = ? AND taggable_id = ?", [$processTypeId, 'App\Models\Cvr', $cvrStep->cvr_id]);

        return redirect()->route('cvr_steps.show', $cvrStep->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
