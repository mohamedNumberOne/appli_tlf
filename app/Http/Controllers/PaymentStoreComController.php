<?php

namespace App\Http\Controllers;

use App\Models\Payment_Store_Com;
use App\Models\Store;
use App\Models\User;
use App\Http\Requests\StorePayment_Store_ComRequest;
use App\Http\Requests\UpdatePayment_Store_ComRequest;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Auth;


class PaymentStoreComController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paiement_store_page()
    {

        $all_store_com_p =  Payment_Store_Com::join('users as prop_store', 'payment__store__coms.seller_id', '=', 'prop_store.id')
            // Jointure pour obtenir le user prop_store
            ->join('users as commercial', 'payment__store__coms.commercial_id', '=', 'commercial.id') // Jointure pour obtenir le commercial
            ->join('stores', 'stores.id_prop', '=', 'prop_store.id') // Jointure pour obtenir le store
            ->select(
            "payment__store__coms.*",
                'stores.store_name',
                'prop_store.name as prop_name', // Nom du propriétaire
               
                'prop_store.tlf as tlf_prop', // tlf du propriétaire
                'commercial.name as commercial_name', // Nom du commercial
                'prop_store.solde as total_to_pay' //   solde_store 
            )

            ->paginate(15);

        return view('admin.paiement_store', compact('all_store_com_p'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ajouter_paiement_page()
    {
        $solde = Auth::user()->solde;
        $mes_engagements =  Payment_Store_Com::where('seller_id', '=', (Auth::user()->id))->paginate(15);
        return view("stores.ajouter_paiement", compact("solde", "mes_engagements"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add_p_stoer_com(StorePayment_Store_ComRequest $request)
    {


        $id_user_store = Auth::user()->id;
        $solde_store = Auth::user()->solde;

        $commercial =  Store::where("id_prop", '=', $id_user_store)->first();
        $id_commercial =  $commercial->id_added_by_com;

        if (($request->montant) >= 1000 && ($request->montant) <=  $solde_store) {

            Payment_Store_Com::create([
                "seller_id"     =>  $id_user_store,
                "commercial_id" => $id_commercial,
                "seller_engagement" => 1,
                "commercial_engagement" => 0,
                "photo_money" => NULL,
                "montant" =>  $request->montant,
                "payment_done" =>  0,
            ]);

            return redirect()->back()->with('success', "Engagement démmaré ! En attente de validation ...");
        } else {
            return redirect()->back()->with('error', "le montant doit être 1000Da ou plus! et  ne doit pas dépasser votre solde");
        }
    }

    /**
     * Display the specified resource.
     */
    public function recevoir_p_com_page(Payment_Store_Com $payment_Store_Com)
    {
        // njib asmawat les store +  le prop 
        $solde = Auth::user()->solde;
        $id_com = Auth::user()->id;
        $mes_engagements =  Payment_Store_Com::where('commercial_id', '=',   $id_com)->paginate(10);
        return view('commercials.recevoir_p_com_page', compact("solde", "mes_engagements"));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function recevoir_p_com(UpdatePayment_Store_ComRequest $request,  $id)
    {


        $engagement = Payment_Store_Com::find($id);


        if ($request->hasFile('photo_money')  &&  $request->file('photo_money')->isValid()) {

            $file = $request->file('photo_money');
            $photo_money = $file->store('photos_argent', 'public');

            $commercial = User::find((Auth::user()->id));

            $new_solde_com = ($commercial->solde + $engagement->montant);
            $seller = User::find($engagement->seller_id);
            $new_solde_seller = ($seller->solde - $engagement->montant);


            if (
                $engagement->update([
                    "commercial_engagement" => 1,
                    "photo_money" =>  $photo_money,
                    "payment_done" =>   1,
                    "date_confirm_com" =>   Carbon::now(),
                ])
            ) {

                if (
                    $commercial->update([
                        "solde" =>  $new_solde_com
                    ])
                    &&
                    $seller->update([
                        "solde" =>   $new_solde_seller
                    ])
                ) {

                    return redirect()->back()->with("success", "Paiement accompli");
                } else {
                    return redirect()->back()->with("error", "   Erreur 1  !");
                }
            } else {
                return redirect()->back()->with("error", "   Erreur 2 !");
            }
        } else {
            return redirect()->back()->with("error", "  Ajouter une photo valide !");
        }
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_Store_Com $payment_Store_Com)
    {
        //
    }
}
