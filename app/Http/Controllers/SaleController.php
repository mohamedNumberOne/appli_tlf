<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\History;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as Auth_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


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


        $id_pro = $request->product_id;

        $pro = Product::find($id_pro);

        if ($pro) {


            $imei2 =   NULL;

            // Définition des règles de validation
            $rules = [
                'product_id' => 'required|exists:products,id',

                'imei1' => 'required|digits:15|unique:sales,imei1',
                'sn' => 'required|string|max:255',
                'info_product_img' => 'required|file|image|mimes:jpeg,png,jpg,gif,bmp,webp|max:2048',
                'nom_client' => 'required|string|max:255',
                'tlf_client' => 'required|digits_between:8,15',
            ];

            // Ajouter la validation de imei2 si le produit est double puce
            if ($pro->double_puce) {
                $rules['imei2'] = 'required|digits:15|unique:sales,imei2';
                $imei2 =  $request->imei2;
            }


            $validated = $request->validate(
                $rules,
                [
                    'product_id.exists' => 'le produit n\'existe pas',
                    'imei1.digits' => 'IMEI1 doit contenir 15 chiffres',
                    'imei2.digits' => 'IMEI2 doit contenir 15 chiffres',
                    'imei1.unique' => 'IMEI1 existe déja !',
                    'imei2.unique' => 'IMEI2  existe déja !'
                ]
            );



            if ($validated) {

                if ($request->hasFile('info_product_img')  &&  $request->file('info_product_img')->isValid()) {

                    $file = $request->file('info_product_img');
                    $info_product_img = $file->store('img_sale_phones', 'public');
                } else {
                    $info_product_img  = NULL;
                }


                $seller_id = Auth_user::user()->id;

                $sale_id =   Sale::create([

                    'product_id' => $request->product_id,
                    'seller_id' =>   $seller_id,
                    'imei1' => $request->imei1,
                    'imei2' => $imei2,
                    'sn' => $request->sn,
                    'info_product_img' => $info_product_img,
                    'nom_client' => $request->nom_client,
                    'tlf_client' => $request->tlf_client,

                ]);

                History::create([
                    'product_id' => $request->product_id,
                    'imei1' => $request->imei1,
                    'imei2' => $imei2,
                    'sale_id' => $sale_id->id,
                    'sn' => $request->sn,
                    'info_product_img' => $info_product_img,
                    'nom_client' => $request->nom_client,
                    'tlf_client' => $request->tlf_client,
                ]);


                $user =  User::find((Auth_user::user()->id));
                $new_solde  =  ($pro->prix_garantie) +   ($user->solde);

                $user->update([
                    "solde" => $new_solde
                ]);

                return redirect()->back()->with('success', 'produit vendu avec succés');
            } else {
                return redirect()->back()->with('error', 'Erreur!');
            }
        } else {
            return redirect()->back()->with('error', 'Erreur produit non trouvé!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function mes_ventes()
    {
        $today = Carbon::now()->toDateString();

        $sales = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.product_name', 'products.prix_garantie')
            ->where('sales.seller_id', '=', (Auth_user::user()->id))
            ->orderBy('sales.created_at', "DESC")
            ->paginate(10);

        $sales = Sale::join('products', 'products.id', 'sales.product_id')
            ->select(
                'sales.*',
                'products.product_name',
                'products.prix_garantie',
                DB::raw("DATE_ADD(sales.created_at, INTERVAL products.nb_jr_garantie DAY) as garantie_expiration")
            )
            ->where('sales.seller_id', Auth_user::user()->id)
            ->whereRaw("DATE_ADD(sales.created_at, INTERVAL products.nb_jr_garantie DAY) > ?", [$today]) // Filtrer les ventes encore sous garantie
            ->orderBy('sales.created_at', "DESC")
            ->paginate(2);

        return view("stores.mes_ventes_page", compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function modification($sale)
    {
        $sale = Sale::find($sale);


        if (! $sale) {
            return  redirect()->route('dashboard_store')->with("error", "erreur");
        } else {
            $all_pro = Product::all();

            $sale_info = Sale::join("products", 'products.id', '=', "sales.product_id")
                ->select("sales.*", "products.product_name")
                ->where("products.id",   $sale->product_id)
                ->first();

            return view('stores.update_sales', compact('sale', "all_pro"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function modification_vente(Request $request,  $sale)
    {
        $sale = Sale::find($sale);
        $id_pro = $request->product_id;

        $pro = Product::find($id_pro);



        if ($pro) {


            $imei2 =   '';

            // Définition des règles de validation
            $rules = [
                'product_id' => 'required|exists:products,id',
                'imei1' => 'required|digits:15|unique:sales,imei1,' . $sale->id,
                'sn' => 'required|string|max:255',
                'info_product_img' => 'file|image|mimes:jpeg,png,jpg,gif,bmp,webp',
                'nom_client' => 'required|string|max:255',
                'tlf_client' => 'required|digits_between:8,15',
            ];

            // Ajouter la validation de imei2 si le produit est double puce
            if ($pro->double_puce) {
                $rules['imei2'] = 'required|digits:15|unique:sales,imei2,' . $sale->id;
                $imei2 =  $request->imei2;
            }


            $validated = $request->validate(
                $rules,
                [
                    'product_id.exists' => 'le produit n\'existe pas',
                    'imei1.digits' => 'IMEI1 doit contenir 15 chiffres',
                    'imei2.digits' => 'IMEI2 doit contenir 15 chiffres',
                    'imei1.unique' => 'IMEI1 existe déja !',
                    'imei2.unique' => 'IMEI2  existe déja !',
                ]
            );



            if ($validated) {

                if ($request->hasFile('info_product_img')  &&  $request->file('info_product_img')->isValid()) {

                    $file = $request->file('info_product_img');
                    $info_product_img = $file->store('img_sale_phones', 'public');
                } else {
                    $info_product_img  =   $sale->info_product_img;
                }

                //  la 1ere image troh l history , w la nouvelle   troh l sale 


                $sale->update([
                    'product_id' => $request->product_id,
                    'imei1' => $request->imei1,
                    'imei2' => $imei2,
                    'sn' => $request->sn,
                    'info_product_img' => $info_product_img,
                    'nom_client' => $request->nom_client,
                    'tlf_client' => $request->tlf_client,
                ]);



                History::create([
                    'product_id' => $request->product_id,
                    'imei1' => $request->imei1,
                    'imei2' => $imei2,
                    'sn' => $request->sn,
                    'sale_id' => $sale->id,
                    'info_product_img' => $info_product_img,
                    'nom_client' => $request->nom_client,
                    'tlf_client' => $request->tlf_client,
                ]);



                return redirect()->back()->with('success', 'produit modifié');
            } else {
                return redirect()->back()->with('error', 'Erreur!');
            }
        } else {
            return redirect()->back()->with('error', 'Erreur produit non trouvé!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
