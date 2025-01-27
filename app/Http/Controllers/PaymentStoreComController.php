<?php

namespace App\Http\Controllers;

use App\Models\Payment_Store_Com;
use App\Http\Requests\StorePayment_Store_ComRequest;
use App\Http\Requests\UpdatePayment_Store_ComRequest;

class PaymentStoreComController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paiement_store_page()
    {
        return view("admin.paiement_store") ;
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
    public function store(StorePayment_Store_ComRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment_Store_Com $payment_Store_Com)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment_Store_Com $payment_Store_Com)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayment_Store_ComRequest $request, Payment_Store_Com $payment_Store_Com)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_Store_Com $payment_Store_Com)
    {
        //
    }
}
