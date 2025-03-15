<?php

namespace App\Http\Controllers;

use App\Models\Payment_Com_Admin;
use App\Models\Payment_Store_Com;
use App\Http\Requests\StorePayment_Com_AdminRequest;
use App\Http\Requests\UpdatePayment_Com_AdminRequest;


class PaymentComAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paiement_commerciaux_page()
    {
        $all_p_confirmed =  Payment_Store_Com::where('payment_done', 1) -> paginate(10) ;
         
        return view("admin.paiement_commerciaux" , compact("all_p_confirmed") ) ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function recevoir_p_admin()
    {
      
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayment_Com_AdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment_Com_Admin $payment_Com_Admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment_Com_Admin $payment_Com_Admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayment_Com_AdminRequest $request, Payment_Com_Admin $payment_Com_Admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_Com_Admin $payment_Com_Admin)
    {
        //
    }
}
