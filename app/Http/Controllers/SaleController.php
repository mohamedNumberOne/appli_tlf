<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\Request ;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as Auth_user;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ajouter_vente_page()
    {
        $all_pro = Product::orderBy('product_name')->get();
        return view("stores.add_sale", compact('all_pro'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function ajouter_vente(Request $request)
    {


        $pro = Product::find($request->product_id);
        $imei2 =   NULL;
        $validated = $request->validate([]) ;

        $validated = [
            'product_id' => 'required|exists:products,id|numeric',
            'seller_id' => 'required|exists:users,id|numeric', 
            'imei1' => 'required|digits:15|unique:sales,imei1',
            'sn' => 'required|string',
            'info_product_img' => 'required|file|image|mimes:jpeg,png,jpg,gif,bmp,webp',
            'nom_client' => 'required|string',
            'tlf_client' => 'required|digits_between:8,15',
        ];

        if ($pro->double_puce) {
            $imei2 = $request->imei2;
            $validated = ['imei2' => 'required|digits:15|unique:sales,imei2'];
        }
      
      

        if ($validated) {


            if ($request->hasFile('info_product_img')  &&  $request->file('info_product_img')->isValid()) {

                $file = $request->file('info_product_img');
                $info_product_img = $file->store('img_sale_phones', 'public');
            } else {
                $info_product_img  = NULL;
            }



            $seller_id =  Auth_user::user()->id;

            Sale::create([

                'product_id' => $request->product_id,
                'seller_id' =>   $seller_id ,
                'imei1' => $request->imei1,
                'imei2' => $imei2,
                'sn' => $request->sn,
                'info_product_img' => $info_product_img,
                'nom_client' => $request->nom_client,
                'tlf_client' => $request->tlf_client,

            ]);

            return redirect()->back()->with('success', 'produit vendu avec succés');
        }else {
            return redirect()->back()->with('error', 'Erreur!');

        }

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
