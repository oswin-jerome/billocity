<?php

namespace App\Http\Controllers;

use App\Models\EmiEntry;
use Illuminate\Http\Request;

class EmiEntryController extends Controller
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
     * @param  \App\Models\EmiEntry  $emiEntry
     * @return \Illuminate\Http\Response
     */
    public function show(EmiEntry $emiEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmiEntry  $emiEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(EmiEntry $emiEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmiEntry  $emiEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmiEntry $emiEntry)
    {
        // return $emiEntry;
        $emiEntry->paid = $emiEntry->payable;
        $emiEntry->paid_date = now();
        $emiEntry->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmiEntry  $emiEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmiEntry $emiEntry)
    {
        //
    }
}
