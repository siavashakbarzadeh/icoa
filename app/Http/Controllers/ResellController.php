<?php

namespace App\Http\Controllers;

use App\Models\Resell;
use App\Http\Requests\StoreResellRequest;
use App\Http\Requests\UpdateResellRequest;
use App\Imports\ResellsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResellController extends Controller
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
     * @param  \App\Http\Requests\StoreResellRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResellRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function show(Resell $resell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function edit(Resell $resell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResellRequest  $request
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResellRequest $request, Resell $resell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resell $resell)
    {
        //
    }
    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new ResellsImport, $file);

        return redirect()->back()->with('success', 'CSV imported successfully.');
    }
}
