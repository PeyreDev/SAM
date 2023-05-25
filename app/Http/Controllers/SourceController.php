<?php

namespace App\Http\Controllers;

use App\Models\Gas_flow;
use App\Models\Gas_line;
use App\Models\Precursor_properties;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::all();
        //$gaslinesources = DB::table('gas_line_source')->get();

        return view('sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precursors = Precursor_properties::all();
        $gasLines = Gas_line::where('remove_date', null)->get();
        $date = new \DateTime();
        $dateTimeStr = $date->format('Y-m-d');

        return view('sources.create', compact('precursors', 'gasLines', 'dateTimeStr'));
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
            'reference'                => ['required', 'string', 'unique:sources,reference'],
            'supplier'                 => ['required'],
            'quantity'                 => ['required'],
            'manufacturing_date'       => ['nullable', 'date'],
            'purity'                   => ['required', 'string'],
            'dilution'                 => ['nullable', 'string'],
            'conditionning'            => ['required', 'string'],
            'precursor_properties_id'  => ['required', 'numeric'],
        ]);

        $source = $request->except('gas_line_id', 'date_out');
        Source::create($source);

        // we populate the gasLineSource table
        $dateIn = $request->input('date_in');
        $gasLineId = $request->input('gas_line_id');
        $sourceId = Source::where('reference', $source['reference'])->first();

        DB::update("UPDATE gas_line_source SET date_out = ? WHERE date_out IS NULL AND gas_line_id = ?", [$dateIn, $gasLineId]);
        DB::insert('INSERT INTO gas_line_source (gas_line_id, source_id, date_in) values (?, ?, ?)', [$gasLineId, $sourceId->id, $dateIn]);

        return redirect()->route('sources.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $source = Source::where('id', $id)->first();
        $latestGasLine = $source->latestGasLine->first();
        $gasLines = $source->gasLines()->get();
        $gaslinesources = DB::table('gas_line_source')->get();

        // Gaslines associated??
        if ($latestGasLine == null)
        {
            $hidden = 'hidden';
        }
        else
        {
            $hidden = '';
        }

        return view('sources.show', compact('source', 'latestGasLine', 'gasLines', 'gaslinesources', 'hidden'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $source = Source::where('id', $id)->first();
        $precursors = Precursor_properties::all();

        $gasLineId = $source->latestGasLine->first()->id;
        $gasLineSource = DB::table('gas_line_source')->where('gas_line_id', $gasLineId)->where('source_id', $source->id)->latest('date_in')->first();
        $dateIn = $gasLineSource->date_in;
        $dateOut = $gasLineSource->date_out;

        $dateIn = strtotime($dateIn);
        $newDateIn = date('Y-m-d', $dateIn);

        $dateOut = strtotime($dateOut);
        $newDateOut = date('Y-m-d', $dateOut);

        return view('sources.edit', compact('source', 'precursors', 'newDateIn', 'newDateOut', 'dateOut', 'gasLineSource'));
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
            'reference'                => ['required', 'string'],
            'supplier'                 => ['required'],
            'quantity'                 => ['required'],
            'manufacturing_date'       => ['nullable', 'date'],
            'purity'                   => ['required', 'string'],
            'dilution'                 => ['nullable', 'string'],
            'conditionning'            => ['required', 'string'],
            'precursor_properties_id'  => ['required', 'numeric'],
        ]);

        $source = $request->except(['_token', '_method', 'date_in', 'date_out']);
        Source::where('id', $id)->update($source);

        $source = Source::where('id', $id)->first();
        $gasLineId = $source->latestGasLine->first()->id;

        $dateIn = $request->input('date_in');
        $dateOut = $request->input('date_out');

        DB::update("UPDATE gas_line_source SET date_out = ? , date_in = ? WHERE source_id = ? AND gas_line_id = ?", [$dateOut, $dateIn, $id, $gasLineId]);



        return redirect()->route('sources.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //we recover the gasflows corresponding to the source
        $gasFlow = Gas_flow::where('source_id', $id)->first();

        if(isset($gasFlow)) {
            if ($gasFlow->source_id == null && $gasFlow->source_id == '') {
                DB::table('gas_line_source')->where('source_id', $id)->delete();
                Source::where('id', $id)->delete();
            } else {
                echo "<script language='JavaScript'> alert('you cannot delete this source because it is used in gasflow')</script>" . "<script> window.location = 'http://localhost/sources';</script>";
            }
        }
        else
        {
            DB::table('gas_line_source')->where('source_id', $id)->delete();
            Source::where('id', $id)->delete();
        }

        return redirect()->route('sources.index');
    }
}
