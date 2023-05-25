<?php

namespace App\Http\Controllers;

use App\Models\Substrate;
use App\Models\Substrate_batch;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubstrateBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $substrateBatches = Substrate_batch::all();
        $tags = Tag::all();

        return view('substrate_batches.index', compact('substrateBatches', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //1-> id tag category material & 6-> id tag category orientation
        $materials = Tag::where('tagcat_id', 1)->get();
        $orientations = Tag::where('tagcat_id', 6)->get();

        return view('substrate_batches.create', compact('materials', 'orientations'));
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
            'initial_quantity'   => ['required', 'numeric'],
            'name'               => ['required', 'string'],
            'provider'           => ['string', 'nullable'],
            'material'           => ['required'],
            'thickness'          => ['numeric', 'nullable'],
            'resistivity'        => ['numeric', 'nullable'],
            'orientation'        => ['required'],
            'miscut'             => ['numeric', 'nullable'],
            'element_size'       => ['required', 'string'],
            'doping'             => ['numeric', 'nullable'],
            'doping_type'        => ['required'],
            'doping_element'     => ['alpha', 'nullable'],
            'comment'            => ['nullable'],
        ]);

        $substrateBatch = $request->input();
        $substrateBatch['user_id'] = Auth::id();
        $substrateBatch['remaining_quantity'] = $substrateBatch['initial_quantity'];

        Substrate_batch::create($substrateBatch);

        return redirect()->route('substrate_batches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $substrateBatch = Substrate_batch::where('id', $id)->first();
        $user = User::where('id', $substrateBatch->user_id)->first();

        return view('substrate_batches.show', compact('substrateBatch', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $substrateBatch = Substrate_batch::where('id', $id)->first();

        //1-> id tag category material & 6-> id tag category orientation
        $materials = Tag::where('tagcat_id', 1)->get();
        $orientations = Tag::where('tagcat_id', 6)->get();

        return view('substrate_batches.edit', compact('substrateBatch', 'materials', 'orientations'));
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
            'initial_quantity'       => ['required', 'numeric'],
            'remaining_quantity'     => ['required', 'numeric'],
            'name'                   => ['required', 'string'],
            'provider'               => ['string', 'nullable'],
            'material'               => ['required'],
            'thickness'              => ['numeric', 'nullable'],
            'resistivity'            => ['numeric', 'nullable'],
            'orientation'            => ['required'],
            'miscut'                 => ['numeric', 'nullable'],
            'element_size'           => ['required'],
            'doping'                 => ['numeric', 'nullable'],
            'doping_type'            => ['required'],
            'doping_element'         => ['alpha', 'nullable'],
            'comment'                => ['nullable'],
        ]);


        $substrateBatch = $request->except(['_token', '_method']);
        $substrateBatch['user_id'] = Auth::id();

        Substrate_batch::where('id', $id)->update($substrateBatch);

        return redirect()->route('substrate_batches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Substrate_batch::where('id', $id)->delete();

        return redirect()->route('substrate_batches.index');
    }
}
