<?php

namespace App\Http\Controllers;

use App\Models\Return_p;
use App\Http\Requests\StoreReturn_pRequest;
use App\Http\Requests\UpdateReturn_pRequest;
use App\Models\Sale;

class ReturnPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_retour(StoreReturn_pRequest $request)
    {

        $sale_id = $request->sale_id;

        $sale =  Sale::find($sale_id);
        if ($sale) {
            Return_p::create([

                "problem" => $request->problem,
                "sale_id" => $sale_id
            ]);

            return redirect()->back()->with("success", "Retour Ajouté!");
        } else {
            return redirect()->back()->with("error", "Erreur1!");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturn_pRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Return_p $return_p)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Return_p $return_p)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReturn_pRequest $request, Return_p $return_p)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Return_p $return_p)
    {
        //
    }
}
