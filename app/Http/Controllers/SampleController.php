<?php

namespace App\Http\Controllers;

use App\Models\Cvr_step;
use App\Models\External_sample;
use App\Models\Process_step;
use App\Models\Sample;
use App\Models\Substrate;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('samples.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('samples.create');
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
            'name'                => ['unique:samples,name'],
            'size'                => [''],
            'parent_position'     => [''],
            'parent_name'         => [''],
            'available'           => [''],
            'localisation'        => [''],
            'comment'             => [''],
            'sampleFrom'          => [''],
            'position'            => [''],
            'face'                => [''],
            'substrate_batch_id'  => [''],
            'origin'              => [''],
        ]);

        $sample = $request->except(['sampleFrom','substrate_batch_id', 'position', 'face', 'origin']);
        Sample::create($sample);

        if($request->input('sampleFrom') == 'fromBatch')
        {
            $substrate = $request->except(['name', 'size', 'parent_position', 'parent_name', 'available', 'localisation', 'comment', 'sampleFrom', 'origin', '_token']);

            Substrate::create($substrate);

            $substrate = Substrate::where('position', $request->input('position'))->where('substrate_batch_id', $request->input('substrate_batch_id'))->first();

            $sampleStep = [
                'date'         => new \DateTime(),
                'related_type' => 'App\Models\Substrate',
                'related_id'   => $substrate->id,
                'user_id'      => Auth::id()
            ];

            Process_step::create($sampleStep);

            $processStep = Process_step::where('related_type', 'App\Models\Substrate')->where('related_id', $substrate->id)->first();
            $sample = Sample::where('name', $request->input('name'))->first();

            DB::insert('INSERT INTO process_step_sample (sample_id, process_step_id) VALUES(?, ?)', [$sample->id, $processStep->id]);
        }
        elseif($request->input('sampleFrom') == 'fromExternal')
        {
            $external = $request->except(['name', 'size', 'parent_position', 'parent_name', 'available', 'localisation', 'comment', 'sampleFrom', 'position', 'face', '_token']);

            $externalSample = External_sample::create($external);

            $sampleStep = [
                'date'         => new \DateTime(),
                'related_type' => 'App\Models\External_sample',
                'related_id'   => $externalSample->id,
                'user_id'      => Auth::id()
            ];

            Process_step::create($sampleStep);

            $processStep = Process_step::where('related_type', 'App\Models\External_sample')->where('related_id', $externalSample->id)->first();
            $sample = Sample::where('name', $request->input('name'))->first();

            DB::insert('INSERT INTO process_step_sample (sample_id, process_step_id) VALUES(?, ?)', [$sample->id, $processStep->id]);
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
        $sample = Sample::where('id', $id)->first();
        $sampleTags = $sample->tags;
        $parent = Sample::where('id', $sample->parent_id)->first();
        $processSteps = $sample->processStepsDesc;
        $users = User::all();
        $cvrsteps = Cvr_step::all();

        if(isset($parent))
        {
            $parentSteps = $parent->processStepsDesc;
        }
        else
        {
            $parentSteps = [];
        }

        if(isset($parent->name))
        {
            $parentName = $parent->name;
        }
        else
        {
            $parentName = 'N/A';
        }

        return view('samples.show', compact('sample', 'parentName', 'processSteps', 'sampleTags', 'users', 'parentSteps', 'cvrsteps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
