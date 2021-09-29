<?php

namespace App\Http\Controllers;

use App\DataTables\EmisDataTable;
use App\Models\Emi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EmiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmisDataTable $dataTable)
    {
        return $dataTable->render('pages/emi/view');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.emi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emi = Emi::create($request->all());
        $date = $request->start_date;
        $interval = "month";
        switch ($request->interval) {
            case 'monthly':
                $interval = "month";
                break;
            case 'weekly':
                $interval = "week";
                break;
            case 'daily':
                $interval = "day";
                break;
            
            default:
                # code...
                break;
        }
        for ($i=0; $i < $request->period; $i++) { 
            $time = strtotime($date);
            $emi->emi_entries()->create([
                "date"=>$date,
                "payable"=>12,
            ]);
            $final = date("Y-m-d", strtotime("+1 ".$interval, $time));
            $date = $final;
        }
        Toastr::success("User added", 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function show(Emi $emi)
    {
        return view('pages/emi/show',[ "emi" => $emi ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emi $emi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emi $emi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emi $emi)
    {
        //
    }
}
