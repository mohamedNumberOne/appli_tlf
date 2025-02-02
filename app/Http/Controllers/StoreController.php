<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public   function get_nb_stores() {
        $all_stores = Store::count();
        return $all_stores ;
    }
    

    public function liste_store()
    {
        $all_stores = 
        Store::join('users as owner', 'stores.id_prop', '=', 'owner.id') // Jointure pour obtenir le propriétaire
            ->join('users as commercial', 'stores.id_added_by_com', '=', 'commercial.id') // Jointure pour obtenir le commercial
            ->select(
                'stores.store_name',
                'stores.id as store_id',
                'owner.name as prop_name', // Nom du propriétaire
                'owner.email as email_prop', // email du propriétaire
                'owner.tlf as tlf_prop', // tlf du propriétaire
                'commercial.name as commercial_name', // Nom du commercial
                'stores.total_to_pay' //   total_to_pay
            )
            
            ->orderBy('stores.created_at', "DESC")->paginate(10);
        return view("admin.stores_liste", compact("all_stores"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function commercial_liste_store()
    {
        $all_stores = 
        Store::join('users as owner', 'stores.id_prop', '=', 'owner.id') // Jointure pour obtenir le propriétaire
            ->join('users as commercial', 'stores.id_added_by_com', '=', 'commercial.id') // Jointure pour obtenir le commercial
            ->select(
                'stores.store_name',
                'stores.id as store_id',
                'owner.name as prop_name', // Nom du propriétaire
                'owner.email as email_prop', // email du propriétaire
                'owner.tlf as tlf_prop', // tlf du propriétaire
                'commercial.name as commercial_name', // Nom du commercial
                'stores.total_to_pay' //   total_to_pay
            )
            
            ->orderBy('stores.created_at', "DESC")->paginate(10);
            
        return view("commercials.stores_liste", compact("all_stores"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
