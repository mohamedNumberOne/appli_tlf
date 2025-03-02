<?php

namespace App\Http\Controllers;

use App\Models\Return_p;
use App\Http\Requests\StoreReturn_pRequest;
use App\Http\Requests\UpdateReturn_pRequest;
use App\Models\Sale;

use Illuminate\Support\Facades\Auth;


 
 


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
            return redirect()->back()->with("error", "Cette vente n'existe  plus!");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function page_retours()
    {



        // verifier ida yakder ydir  retour ( nb jour garantie ida khlas wla  mazl )

    


        $retours =  Return_p::leftJoin('sales', "return_ps.sale_id", "sales.id")
            ->leftJoin('products', "products.id", "sales.product_id")
            ->select(
                'return_ps.*',
                "products.product_name",
                "sales.imei1",
                "sales.imei2",
                "sales.info_product_img",
                "sales.nom_client",
                "sales.tlf_client",
                "sales.sn",
                "return_ps.created_at as date_retour"
            )
            ->where('sales.seller_id', '=',  Auth::user()->id)
            ->paginate(10);

        return view("stores.page_retour", compact("retours"));
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
