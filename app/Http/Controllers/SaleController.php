<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as Auth_user ;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ajouter_vente_page()
    {
        $all_pro = Product::orderBy('product_name')-> get() ;
        return view("stores.add_sale" , compact('all_pro') ) ;
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
    public function store(StoreSaleRequest $request)
    {
       
        Sale::create([

            'product_id' => $request->product_id ,
            'seller_id' => (Auth_user::user()->id),
            'imei1' => $request->imei1 ,
            'imei2' => $request->imei2 ,
            'sn' => $request-> sn ,
            'info_product_img' => $request->info_product_img ,
            'nom_client' => $request->nom_client ,
            'tlf_client' => $request->tlf_client ,
          

        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
