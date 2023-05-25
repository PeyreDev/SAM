<?php

namespace App\Http\Controllers;

use App\Models\Cvr;
use App\Models\Cvr_step;
use App\Models\Equipment;
use App\Models\Gas_flow;
use App\Models\Gas_line;
use App\Models\Process_step;
use App\Models\Special_flow;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CvrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cvrs = Cvr::all();
        $equipments = Equipment::all();

        return view('cvrs.index', compact('cvrs', 'equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = Equipment::all();

        return view('cvrs.create', compact('equipments'));
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
            'recipe_name'       => ['nullable', 'string'],
            'position'          => ['nullable', 'string'],
            'equipment_id'      => ['required', 'integer'],
            'comment'           => ['nullable', 'string'],
            'motivation'        => ['nullable', 'string'],
        ]);

        $cvr = [
            'recipe_name'            => $request->input('recipe_name'),
            'position'               => $request->input('position'),
            'equipment_id'           => $request->input('equipment_id'),
            'comment'                => $request->input('comment'),
            'motivation'             => $request->input('motivation'),
        ];

        $cvr = Cvr::create($cvr);

        $process_step = [
            'date'          => new \DateTime(),
            'related_type'  => 'App\Models\Cvr',
            'related_id'    => $cvr->id,
            'user_id'       => Auth::id(),
        ];

        $process_step = Process_step::create($process_step);

        $nbrProcessStep = count(session('selectedSamples'));
        $selectedSamples = session('selectedSamples');

        foreach ($selectedSamples as $i => $value)
        {
            DB::insert('INSERT INTO process_step_sample (sample_id, process_step_id) VALUES(?, ?)', [$selectedSamples[$i], $process_step->id]);
        }

        for($i = 1; $i <= session('nbrSteps'); $i++)
        {
            $request->validate([
                'pressure_'.$i              => ['required', 'numeric'],
                'duration_'.$i              => ['required'],
                'temperature_initial_'.$i   => ['required', 'numeric'],
                'temperature_final_'.$i     => ['nullable', 'numeric'],
            ]);

            $cvr_step = [
                'pressure'              => $request->input('pressure_'.$i),
                'duration'              => $request->input('duration_'.$i),
                'temperature_initial'   => $request->input('temperature_initial_'.$i),
                'temperature_final'     => $request->input('temperature_final_'.$i),
                'cvr_id'                => $cvr->id,
            ];

            $cvr_step = Cvr_step::create($cvr_step);

            $tagMaterialId = $request->input('material_' . $i);

            DB::insert('INSERT INTO taggables (taggable_type, taggable_id, tag_id) VALUES(?, ?, ?)', ['App\Models\Cvr_step', $cvr_step->id, $tagMaterialId]);

            for($a = 0; $a < session('nbrFlows'); $a++)
            {
                $request->validate([
                    'inject_final_value_' . $i . '_' . $a       => ['nullable', 'numeric'],
                    'MO_pressure_' . $i . '_' . $a              => ['nullable'],
                    'MO_temperature_' . $i . '_' . $a           => ['nullable'],
                    'dilute_value_' . $i . '_' . $a             => ['nullable'],
                    'source_value_' . $i . '_' . $a             => ['nullable'],
                    'inject_initial_value_' . $i . '_' . $a     => ['required', 'numeric'],
                    'gas_line_id_' . $i . '_' . $a              => ['required', 'integer'],
                ]);

                $special_flow = [
                    'inject_final_value' => $request->input('inject_final_value_' . $i . '_' . $a),
                    'MO_pressure'        => $request->input('MO_pressure_' . $i . '_' . $a),
                    'MO_temperature'     => $request->input('MO_temperature_' . $i . '_' . $a),
                    'dilute_value'       => $request->input('dilute_value_' . $i . '_' . $a),
                    'source_value'       => $request->input('source_value_' . $i . '_' . $a),
                ];

                if(isset($special_flow['inject_final_value']) || isset($special_flow['MO_pressure']) || isset($special_flow['dilute_value']))
                {
                    $special_flow = Special_flow::create($special_flow);
                }

                $gasLine = Gas_line::where('id', $request->input('gas_line_id_' . $i . '_' . $a))->first();

                $gas_flow = [
                    'inject_initial_value'          => $request->input('inject_initial_value_' . $i . '_' . $a),
                    'cvr_step_id'                   => $cvr_step->id,
                    'gas_line_id'                   => $request->input('gas_line_id_' . $i . '_' . $a),
                    'source_id'                     => $gasLine->latestSource()->first()->id,
                    'precursor_properties_id'       => $gasLine->latestSource()->first()->precursor()->first()->id,
                ];

                if(isset($special_flow->id))
                {
                    $gas_flow['special_flow_id'] = $special_flow->id;
                }
                else
                {
                    $gas_flow['special_flow_id'] = null;
                }

                Gas_flow::create($gas_flow);
            }
        }

        return redirect()->route('samples.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cvr = Cvr::where('id', $id)->first();
        $equipments = Equipment::all();
        $cvrSteps = $cvr->cvrSteps()->get();
        $tag = $cvr->tags()->first();

        return view('cvrs.show', compact('cvr', 'equipments', 'cvrSteps', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cvr = Cvr::where('id', $id)->first();
        $equipments = Equipment::all();
        $tags = Tag::where('tagcat_id', 2)->get(); // tagcat_id : 2 => Process type
        $relatedTag = $cvr->tags()->first(); // for preselection of process type

        return view('cvrs.edit', compact('cvr', 'equipments', 'tags', 'relatedTag'));
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
            'recipe_name'   => ['nullable'],
            'position'      => ['nullable'],
            'equipment_id'  => ['required'],
            'comment'       => ['nullable', 'string'],
            'motivation'    => ['nullable', 'string'],
        ]);

        $cvr = $request->except(['_token', '_method', 'process_type']);
        Cvr::where('id', $id)->update($cvr);

        //we update the taggable table
        $processTypeId = $request->input('process_type');

        DB::insert("INSERT INTO taggables (taggable_type, taggable_id, tag_id) VALUES(?, ?, ?)", ['App\Models\Cvr', $id, $processTypeId]);

        return redirect()->route('cvrs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cvr::where('id', $id)->delete();

        return redirect()->route('cvrs.index');
    }
}
