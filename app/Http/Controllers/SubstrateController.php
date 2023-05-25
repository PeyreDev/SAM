<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\Substrate;
use App\Models\Substrate_batch;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SubstrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $substrate = Substrate::where('id', $id)->first();
        $substrateBatch = Substrate_batch::where('id', $substrate->substrate_batch_id)->first();
        $user = User::where('id', $substrateBatch->user_id)->first();

        $sampleId = session('sampleId');
        $sample = Sample::where('id', $sampleId)->first();

        return view('substrates.show', compact('substrate', 'substrateBatch', 'user', 'sample'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $substrate = Substrate::where('id', $id)->first();
        $substrateBatch = Substrate_batch::where('id', $substrate->substrate_batch_id)->first();
        $user = User::where('id', $substrateBatch->user_id)->first();

        $sampleId = session('sampleId');
        $sample = Sample::where('id', $sampleId)->first();

        return view('substrates.edit', compact('substrate', 'substrateBatch', 'user', 'sample'));
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
           'position'   => ['required'],
           'face'       => ['required'],
        ]);

        $substrate = $request->except(['_token', '_method']);

        Substrate::where('id', $id)->update($substrate);

        return redirect()->route('substrates.show', $id);
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
